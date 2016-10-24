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

}