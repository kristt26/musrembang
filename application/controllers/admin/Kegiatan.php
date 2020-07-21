<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Kegiatan_model', 'KegiatanModel');
    }
    
    public function index()
    {
        $title['title'] = ['header'=>'Kegiatan', 'dash'=>'Kegiatan'];    
        $this->load->view('admin/template/header');
        $this->load->view('admin/kegiatan');
        $this->load->view('admin/template/footer');
    }

    public function getdata()
    {
        $result = $this->KegiatanModel->select();
        echo json_encode($result);
    }

    public function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if(!isset($data['idKegiatan'])){
            $result = $this->KegiatanModel->insert($data);
            if($result === false){
                var_dump(http_response_code(400));
            }else{
                echo json_encode($result);
            }
        }else{
            $result = $this->KegiatanModel->update($data);
            if($result === false){
                var_dump(http_response_code(400));
            }else{
                echo json_encode($result);
            }
        }
    }

    public function haspus($idKegiatan)
    {
        $result = $this->KegiatanModel->delete($idKegiatan);
        if($result)
            var_dump(http_response_code(200));
        else
            var_dump(http_response_code(400));
    }
}

/* End of file Controllername.php */
