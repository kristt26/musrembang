<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Bidang_model', 'BidangModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_model', 'ProfileModel');
    }

    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Bidang', 'dash' => 'Bidang', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Bidang', 'dash' => 'Bidang', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }
        // $title['title'] = ['header' => 'Bidang', 'dash' => 'Bidang', 'tahun' => $periode[0], 'profile' => $profile, 'periode' => $periodeaktif[0]];
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
        if (!isset($data['idbidang'])) {
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
