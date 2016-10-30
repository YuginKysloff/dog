<? defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('/admin/Users_model');
        $this->load->library('form_validation');
//        $this->load->library('pagination');
    }


    public function index($sort = FALSE)
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
            // Получение списка всех пользователей
            $data['users'] = $this->Users_model->get_all_users();
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
                    // Валидация POST данных
                    if ($this->form_validation->run() == TRUE)
                    {
                        // Подготовка данных и запись в базу
                        $data['edit'] = array(
                            'login' => $this->input->post('login'),
                            'name' => $this->input-> post('name'),
                            'email' => $this->input->post('email'),
                            'password' => strrev(hash('sha512', $this->input->post('password').$this->config->item('pass_key'))),
                            'group' => $this->input->post('group'),
                        );
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