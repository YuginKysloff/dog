<? defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Автовход если есть куки
        $this->autoLogin();
    }

    //main render -------------------------------------------------------------------------------------------------------------------
    public function pages_render($slug, $data)
    {
        //render view
        $this->load->view('templates/header_view',$data);
        $this->load->view($slug.'_view');
        $this->load->view('templates/footer_about_view');
    }

    //admin render -------------------------------------------------------------------------------------------------------------------
    public function admin_render($page, $slug, $data)
    {
        // Получение количества нвых записей за сутки
        $this->load->model('/admin/Aside_model');
        $data['last']['users'] = $this->Aside_model->countLastUsers();
        $data['last']['warn'] = $this->Aside_model->countLastWarn();
        //render view
        $this->load->view('admin/templates/header_view',$data);
        $this->load->view('admin/templates/aside_view');
        $this->load->view('admin/'.$page.'/'.$slug.'_view');
        $this->load->view('admin/templates/footer_view');
    }

    // Возвращает ip
    public function get_ip() {
        if (isset($_SERVER['HTTP_X_REAL_IP']))
            return $_SERVER['HTTP_X_REAL_IP'];
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @param $level, integer, уровень доступа
     * @param $path, string, путь редиректа при недостаточном уровне доступа (/path)
     * @param $source, string, файл строка вызова '('.__FILE__.'/'.__LINE__.')'
     */
    public function check_access($level, $path, $source = '')
    {
        if($this->session->userdata('user') == FALSE && $this->session->userdata('user')['group'] < $level)
        {
            $this->load->model('/admin/Warning_model');
            $data_warn = ['ip' => $this->get_ip(), 'message' => 'Попытка несанкционированного доступа '.$source, 'date' => time()];
            $this->Warning_model->addWarning($data_warn);
            header("Location: ".$path);
        }
        return TRUE;
    }

    /**
     * @return bool
     */
    public function autoLogin()
    {
        // Проверка наличия пользователя в сессии
        if(!$this->session->userdata('user'))
        {
            // Проверка есть ли куки для автовхода
            if($this->input->cookie('user') && $this->input->cookie('hash'))
            {
                // Есть ли такой пользователь в базе
                $this->load->model('admin/Admin_model');
                $user = $this->Admin_model->getUserByLogin($this->input->cookie('user', TRUE));
                if($user)
                {
                    // Проверка хеша
                    $hash = hash('sha512', $user['login'].$user['password'].$this->config->item('pass_key'));
                    if($this->input->cookie('hash') == $hash)
                    {
                        // Записываем данные пользователя в сессию
                        $this->session->set_userdata('user', $user);
                        // Обновляем куки
                        $this->input->set_cookie('user', $user['login'], 604800);
                        $this->input->set_cookie('hash', $hash, 604800);
                        return TRUE;
                    }
                }
            }
            $this->session->set_userdata('user', FALSE);
            return FALSE;
        }
        return TRUE;
    }
} // End of MY_Controller class