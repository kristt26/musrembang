<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Rw extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Rw_model', 'RwModel');
    }

    public function index()
    {
        $title['title'] = ['header'=>'RW', 'dash'=>'RW'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/rw');
        $this->load->view('admin/template/footer');
    }

    function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if(!isset($data['idrw'])){
            $result = $this->RwModel->insert($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Simpan'));
            }                
        }else{
            $result = $this->RwModel->update($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Ubah'));
            } 
        }
    }

    public function getdata()
    {
        $result = $this->RwModel->select();
        echo json_encode($result);
    }

    function hapus($idrw)
    {
        if($this->RwModel->delete($idrw))
            echo json_encode(array('message'=>'Berhasil Hapus'));
        else{
            http_response_code(400);
            echo json_encode(array('message'=>'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
