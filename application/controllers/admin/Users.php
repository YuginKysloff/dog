<? defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('/admin/Users_model');
//        $this->load->library('pagination');
    }

    public function index()
    {
        // Получение списка всех пользователей
        $data['users'] = $this->Users_model->get_all_users();

        // Генерация вида
        $data['title'] = 'Пользователи';
        $this->admin_render('users', 'users', $data);
    }

    public function edit($id)
    {
        // Проверка есть ли пост данные и их обработка
        if($this->input->post('submit'))
        {
            $this->edit_handler();
        }

        // Получение списка всех пользователей
        $data['user'] = $this->Users_model->get_user($id);

        // Генерация вида
        $data['title'] = 'Редактирование пользователя '.$data['user']['login'];
        $this->admin_render('users', 'edit', $data);
    }

    private function edit_handler()
    {
        if ($this->form_validation->run() == TRUE)
        {

            header("Location: /admin/users");
        }
    }
}
