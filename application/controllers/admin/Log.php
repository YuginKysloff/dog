<? defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Проверка доступа в закрытый раздел
        if($this->session->userdata('user_group') < $this->config->item('groups')['admin']) header("Location: /admin");;

//        $this->load->model('/admin/Users_model');
//        $this->load->library('form_validation');
//        $this->load->library('pagination');
    }

    public function index()
    {
        $data['title'] = 'Журнал событий';

        $this->admin_render('log', 'log', $data);
    }
}
