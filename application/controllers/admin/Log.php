<? defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // Проверка доступа в закрытый раздел
        $this->check_access($this->config->item('user_group')['admin'], '/admin', '('.__FILE__.'/'.__LINE__.')');
        // Загрузка моделей и библиотек
        $this->load->model('admin/Log_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    public function index()
    {
        // Настройки пагинации
        $config['base_url'] = '/admin/log/';
        $config['total_rows'] = $this->Log_model->countLog();
        $config['per_page'] = 20;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
        $this->pagination->initialize($config);
        // Получение списка всех пользователей
        $data['log'] = $this->Log_model->getLog($config['per_page'], (int)$this->uri->segment($config['uri_segment']));
        // Генерация вида
        $data['title'] = 'Журнал событий';
        $this->admin_render('log', 'log', $data);
    }
}
