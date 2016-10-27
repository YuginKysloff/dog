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
        // Получение списка всех пользователей
        $data['users'] = $this->Users_model->get_all_users();

        // Генерация вида
        $data['title'] = 'Пользователи';
        $this->admin_render('users', 'users', $data);
    }

    // Изменение статуса пользователя
    public function change_status($status, $id)
    {
        // Проверка входных параметров
        if($status >= 0 || $status < 3)
        {
            // Проверка наличия пользователя в базе
            if($this->Users_model->check_id($id))
            {
                // Изменение статуса и группы пользователя
                if($status == 0)
                {
                    $this->Users_model->update_status($id, ['status' => 1, 'group' => 1]);
                    $response['line_'.$id] = '<span class="label label-success users__status btn" data-status="1" data-id="'.$id.'">Активен</span>';
                }else{
                    $this->Users_model->update_status($id, ['status' => 0, 'group' => 0]);
                    $response['line_'.$id] = '<span class="label label-danger users__status btn" data-status="0" data-id="'.$id.'">Отключен</span>';
                }
            }
        }
        exit(json_encode($response));
    }

    public function edit($id)
    {
        // Получение списка всех пользователей
        $data['user'] = $this->Users_model->get_user($id);

        // Генерация вида
        $data['title'] = 'Редактирование пользователя '.$data['user']['login'];
        $this->admin_render('users', 'edit', $data);
    }
}
