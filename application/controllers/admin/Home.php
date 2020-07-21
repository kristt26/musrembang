<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin/Profile_model', 'ProfileModel');
        
    }
    
    public function index()
    {
        $title['title'] = ['header'=>'Home', 'dash'=>'Home'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }

}

/* End of file Home.php */
