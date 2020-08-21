<?php

defined('BASEPATH') or exit('No direct script access allowed');

class laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Laporan_model', 'LaporanModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_model', 'ProfileModel');
    }

    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Laporan', 'dash' => 'Laporan', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Laporan', 'dash' => 'Laporan', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }
        // $data = ['transaksi' => array(), 'pemesanan' => array()];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/laporan');
        $this->load->view('admin/template/footer');
    }
    public function CetakPDF()
    {
        $this->load->library('mypdf');
        $view = "admin/cetaklaporan";
        $data = $this->LaporanModel->select();
        $this->mypdf->generate($view, $data);
    }
    public function getdata()
    {
        $result = $this->PeriodeModel->selectarsip();
        echo json_encode($result);
    }
    public function getprint($idPeriodeRenker = null)
    {
        $result = $this->LaporanModel->AmbilLaporan($idPeriodeRenker);
        echo json_encode($result);
    }
}

/* End of file Controllername.php */
