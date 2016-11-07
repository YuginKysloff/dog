<? defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Проверка доступа в закрытый раздел
        $this->check_access($this->config->item('user_group')['admin'], '/admin', '('.__FILE__.'/'.__LINE__.')');
        // Загрузка моделей и библиотек
        $this->load->model('admin/Statistics_model');
    }

    public function index()
    {
        // Подготовка данных для вывода
        $data['stat'] = $this->Statistics_model->get_statistics();
        // Генерация вида
        $data['title'] = 'Статистика';
        $this->admin_render('statistics', 'statistics', $data);
    }
}
