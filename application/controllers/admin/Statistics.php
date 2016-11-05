<? defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Проверка доступа в закрытый раздел
        if($this->session->userdata('user_group') < $this->config->item('groups')['admin']) header("Location: /admin");;
        $this->load->model('/admin/Statistics_model');
//        $this->load->library('pagination');
//        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Статистика';

        $data['stat'] = $this->Statistics_model->get_statistics();

        $this->admin_render('statistics', 'statistics', $data);
    }
}
