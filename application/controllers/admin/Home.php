<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_Model', 'ProfileModel');
    }
    
    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        $title['title'] = ['header'=>'Home', 'dash'=>'Home', 'tahun'=>$periode[0], 'profile'=>$profile, 'periode'=>$periodeaktif[0]];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }

}

/* End of file Home.php */
