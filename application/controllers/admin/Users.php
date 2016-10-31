<? defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('/admin/Users_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }


    public function index()
    {
        // Проверка есть ли пост данные и их обработка
        if($this->input->post('search') && $this->input->post('login') != '')
        {
            // Установка правил валидации
            $this->form_validation->set_rules('login', 'логин', 'trim|required|alpha_dash|min_length[5]|max_length[15]');
            // Валидация POST данных
            if ($this->form_validation->run() == TRUE)
            {
                // Получение пользователя по логину
                $data['users'] = $this->Users_model->get_user_by_login($this->input->post('login'));
            }
        }
        else
        {
            // Настройки пагинации
            $config['base_url'] = '/admin/users/';
            $config['total_rows'] = $this->Users_model->count_all_users();
            $config['per_page'] = 20;
            $config['uri_segment'] = 3;
            $config['num_links'] = 1;
            $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = '«';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_link'] = '»';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = '&gt;';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '&lt;';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><span>';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            // Получение списка всех пользователей
            $data['users'] = $this->Users_model->get_all_users((int)$this->uri->segment($config['uri_segment']), $config['per_page']);
        }
        // Генерация вида
        $data['title'] = 'Пользователи';
        $this->admin_render('users', 'users', $data);
    }


    public function edit($id = false)
    {
        // Проверка наличия id
        if($id)
        {
            // Очистка параметра
            $id = strip_tags(trim($id));
            // Получение пользователя по id
            $data['user'] = $this->Users_model->get_user($id);
            // Проверка наличия пользователя
            if($data['user'])
            {
                // Проверка есть ли пост данные и их обработка
                if($this->input->post('submit'))
                {
                    // Установка правил валидации
                    $this->form_validation->set_error_delimiters('<span class="text-red">', '</span>');
                    $this->form_validation->set_rules('login', 'логин', 'trim|required|alpha_dash|min_length[5]|max_length[15]');
                    $this->form_validation->set_rules('name', 'имя', 'trim|alpha_dash');
                    $this->form_validation->set_rules('group', 'группа', 'trim|required|integer|in_list[0,1,2]');
                    if($data['user']['email'] != $this->input->post('email'))
                    {
                        $this->form_validation->set_rules('email', 'e-mail', 'trim|required|valid_email|is_unique['.$this->db->dbprefix('users').'.email]');
                    }
                    if($this->input->post('password') != '' && strrev(hash('sha512', $this->input->post('password').$this->config->item('pass_key'))) != $data['user']['password'])
                    {
                        $this->form_validation->set_rules('password', 'пароль', 'trim|required|alpha_numeric|min_length[6]|max_length[20]');
                        $this->form_validation->set_rules('conf_password', 'повторить', 'trim|required|matches[password]');
                    }
                    // Валидация POST данных, загрузки и ресайза фото
                    if ($this->form_validation->run() == TRUE)
                    {
                        if($_FILES['userfile']['name'] != '')
                        {
                            // Настройки для записи фото
                            $config['upload_path']          = './uploads/users/avatars/';
                            $config['allowed_types']        = 'jpg';
                            $config['file_name']            = 'user'.$data['user']['id'];
                            $config['max_filename']         = 10;
                            $config['overwrite']            = TRUE;
                            $config['max_size']             = 200;
                            $config['max_width']            = 1024;
                            $config['min_width']            = 128;
                            $config['max_height']           = 768;
                            $config['min_height']           = 128;
                            // Загрузка библиотеки
                            $this->load->library('upload', $config);
                            // Настройки ресайза загруженного фото
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = './uploads/users/avatars/user'.$data['user']['id'].'.jpg';
                            $config['maintain_ratio'] = TRUE;
                            $config['width']         = 160;
                            $config['height']       = 160;
                            $this->load->library('image_lib', $config);
                            if($this->upload->do_upload('userfile') == FALSE)
                            {
                                $this->session->set_flashdata('message', $this->upload->display_errors());
                                // Генерация вида
                                $data['title'] = 'Редактирование пользователя '.$data['user']['login'];
                                $this->admin_render('users', 'edit', $data);
                                return;
                            }
                            if($this->image_lib->resize() == FALSE)
                            {
                                $this->session->set_flashdata('message', $this->image_lib->display_errors());
                                // Генерация вида
                                $data['title'] = 'Редактирование пользователя '.$data['user']['login'];
                                $this->admin_render('users', 'edit', $data);
                                return;
                            }
                        }
                        // Подготовка данных и запись в базу
                        $data['edit'] = array(
                            'login' => $this->input->post('login'),
                            'name' => $this->input-> post('name'),
                            'email' => $this->input->post('email'),
                            'password' => strrev(hash('sha512', $this->input->post('password').$this->config->item('pass_key'))),
                            'group' => $this->input->post('group'),
                        );
                        // Запись данных из формы в базу
                        $this->Users_model->update($data['user']['id'], $data['edit']);
                        // Переход на страницу списка пользователей
                        header("Location: /admin/users");
                    }
                }
                // Генерация вида
                $data['title'] = 'Редактирование пользователя '.$data['user']['login'];
                $this->admin_render('users', 'edit', $data);
                return;
            }
        }
        // Переход на страницу ошибки
        show_404();
    }
}