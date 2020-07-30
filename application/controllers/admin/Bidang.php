<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Bidang_model', 'BidangModel');
    }

    public function index()
    {
        $title['title'] = ['header' => 'Bidang', 'dash' => 'Bidang'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/bidang');
        $this->load->view('admin/template/footer');
    }

    public function getdata()
    {
        $result = $this->BidangModel->select();
        echo json_encode($result);
    }

    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if (!isset($data['kd_pegawai'])) {
            $result = $this->BidangModel->insert($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                var_dump(http_response_code(400));
            }

        } else {
            $result = $this->BidangModel->update($data);
            if ($result !== false) {
                echo json_encode($result);
            } else {
                var_dump(http_response_code(400));
            }

        }
    }

    public function hapus($idbidang)
    {
        if ($this->BidangModel->delete($idbidang)) {
            var_dump(http_response_code(200));
        } else {
            var_dump(http_response_code(400));
        }

    }
}

/* End of file Controllername.php */
