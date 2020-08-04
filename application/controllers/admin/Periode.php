<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_Model', 'ProfileModel');
    }

    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Periode Rencana Kerja', 'dash' => 'Periode', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Periode Rencana Kerja', 'dash' => 'Periode', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }
        // $title['title'] = ['header' => 'Periode Rencana Kerja', 'dash' => 'Periode', 'tahun' => $periode, 'profile' => $profile, 'periode' => $periodeaktif[0]];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/periode');
        $this->load->view('admin/template/footer');
    }

    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if (!isset($data['idPeriodeRenker'])) {
            $result = $this->PeriodeModel->insert($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Simpan'));
            }
        } else {
            $result = $this->PeriodeModel->update($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Ubah'));
            }
        }
    }

    public function getdata()
    {
        $result = $this->PeriodeModel->select();
        echo json_encode($result);
    }

    public function hapus($idPeriodeRenker)
    {
        if ($this->PeriodeModel->delete($idPeriodeRenker)) {
            echo json_encode(array('message' => 'Berhasil Hapus'));
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
