<? defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends My_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('/admin/Users_model');
//        $this->load->library('pagination');
//        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Пользователи';

        // Получение списка всех пользователей
        $data['users'] = $this->Users_model->get_all_users();

        // Генерация вида
        $this->admin_render('users', 'users', $data);
    }

    public function change_status()
    {

    }
}
