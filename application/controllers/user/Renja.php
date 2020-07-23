<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Renja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/Renja_model', 'RenjaModel');
    }

    public function index()
    {
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja'];
        $this->load->view('user/template/header', $title);
        $this->load->view('user/renja');
        $this->load->view('user/template/footer');
    }

    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if (!isset($data['idRencanaKerja'])) {
            $result = $this->RenjaModel->insert($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                http_response_code(400);
                echo json_encode(array('message' => 'Gagal Simpan'));
            }
        } else {
            $result = $this->RenjaModel->update($data);
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
        $result = $this->RenjaModel->select();
        echo json_encode($result);
    }

    public function created()
    {
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja'];
        $this->load->view('user/template/header', $title);
        $this->load->view('user/createdrenja');
        $this->load->view('user/template/footer');
    }

    public function hapus($idRencanaKerja)
    {
        if ($this->RenjaModel->delete($idRencanaKerja)) {
            echo json_encode(array('message' => 'Berhasil Hapus'));
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
