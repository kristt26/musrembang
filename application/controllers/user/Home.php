<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin/Profile_model', 'ProfileModel');
    }

    public function index()
    {
        $title['title'] = ['header' => 'Home', 'dash' => 'Home'];
        $this->load->view('user/template/header', $title);
        $this->load->view('user/home');
        $this->load->view('user/template/footer');
        // $this->load->view('user/template/top');
    }

}

/* End of file Home.php */
