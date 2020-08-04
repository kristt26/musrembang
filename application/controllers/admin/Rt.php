<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rt extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Rt_model', 'RtModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_Model', 'ProfileModel');
    }

    public function index($idrw = null)
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Musrenbang | RT', 'dash' => 'RT', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Musrenbang | RT', 'dash' => 'RT', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }
        // $title['title'] = ['header' => 'Musrenbang | RT', 'dash' => 'RT', 'tahun' => $periode, 'profile' => $profile, 'periode' => $periodeaktif[0]];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/rt');
        $this->load->view('admin/template/footer');
    }

    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if (!isset($data['idrt'])) {
            $result = $this->RtModel->insert($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Simpan'));
            }
        } else {
            $result = $this->RtModel->update($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Ubah'));
            }
        }
    }

    public function simpanjalan(Type $var = null)
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if (!isset($data['idjalan'])) {
            $result = $this->RtModel->insertjalan($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Simpan'));
            }
        } else {
            $result = $this->RtModel->updatejalan($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Ubah'));
            }
        }
    }

    public function getdata($idrw = null)
    {
        $result = $this->RtModel->select($idrw);
        echo json_encode($result);
    }

    public function hapus($idrt)
    {
        if ($this->RtModel->delete($idrt)) {
            echo json_encode(array('message' => 'Berhasil Hapus'));
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
