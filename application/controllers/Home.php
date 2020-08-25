<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('admin/Profile_model', 'ProfileModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_model', 'ProfileModel');
        $this->load->model('admin/Home_model', 'HomeModel');
    }

    public function index($idPeriodeRenker = null)
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        if($idPeriodeRenker == null)
            $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        else
            $periodeaktif = $this->PeriodeModel->selectperiodebyid($idPeriodeRenker);
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Musrembang', 'dash' => 'Home', 'tahun' => empty($periode) ? array() : $periode, 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Musrembang', 'dash' => 'Home', 'tahun' => empty($periode) ? array() : $periode, 'profile' => $profile, 'periode' => array()];
        }
        // $this->load->view('user/template/header', $title);
        $this->load->view('guest/home', $title);
        // $this->load->view('user/template/footer');
        // $this->load->view('user/template/top');
    }
    public function getdata($idPeriodeRenker = null)
    {
        $result = $this->HomeModel->select($idPeriodeRenker);
        echo json_encode($result);
        
    }

}

/* End of file Home.php */
