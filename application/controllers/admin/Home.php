<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
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
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Home', 'dash' => 'Home', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Home', 'dash' => 'Home', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }

        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/home');
        $this->load->view('admin/template/footer');
    }
}

/* End of file Home.php */
