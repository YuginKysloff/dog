<?php
class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
//        $this->load->library('session');
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
        if($this->session->userdata('user')['group'] < $level)
        {
            $this->load->model('/admin/Warnings_model');
            $data_warn = ['ip' => $this->get_ip(), 'message' => 'Попытка несанкционированного доступа'.$source, 'date' => time()];
            $this->Warnings_model->addWarning($data_warn);
            header("Location: ".$path);
        }
        return true;
    }
}