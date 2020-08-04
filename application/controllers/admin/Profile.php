<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Profile_model', 'ProfileModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_Model', 'ProfileModel');
    }

    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        if (isset($periodeaktif)) {
            $title['title'] = ['header' => 'Profile Kelurahan', 'dash' => 'Profile', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => $periodeaktif];
        } else {
            $title['title'] = ['header' => 'Profile Kelurahan', 'dash' => 'Profile', 'tahun' => empty($periode) ? array() : $periode[0], 'profile' => $profile, 'periode' => array()];
        }
        // $title['title'] = ['header' => 'Profile Kelurahan', 'dash' => 'Profile', 'profile' => $profile, 'periode' => $periodeaktif[0]];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/profile');
        $this->load->view('admin/template/footer', $title);
    }
    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $result = $this->ProfileModel->insert($data);
        if ($result !== false) {
            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Gagal Simpan'));
        }
    }
    public function getdata()
    {
        $result = $this->ProfileModel->select();
        echo json_encode($result);
    }
    public function upload()
    {
        $cek = $this->ProfileModel->select();
        if (is_null($cek)) {
            echo json_encode(array('message' => 'Data Kelurahan Belum ada'));
        } else {
            $path_to_file = './assets/img/' . $cek->logo;
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 4096;
            $config['encrypt_name'] = true;
            if ($cek->logo != null) {
                if (unlink($path_to_file)) {
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload("file")) {
                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                        $result = $this->ProfileModel->updategambar($image);
                        echo json_encode(array('logo' => $image));
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(array('message' => 'Gagal'));
                }
            } else {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload("file")) {
                    $data = array('upload_data' => $this->upload->data());
                    $image = $data['upload_data']['file_name'];
                    $result = $this->ProfileModel->updategambar($image);
                    echo json_encode(array('logo' => $image));
                } else {
                    http_response_code(400);
                    echo json_encode(array('message' => 'Gagal'));
                }
            }
        }
    }

}

/* End of file Profile.php */
