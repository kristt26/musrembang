<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class RencanaBiaya extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/RencanaBiaya_model', 'RencanaBiayaModel');
    }
    
    public function index()
    {
        $title['title'] = ['header'=>'Rencana Biaya', 'dash'=>'Rencana Biaya'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/rencanabiaya');
        $this->load->view('admin/template/footer');  
    }

    public function getdata()
    {
        $result = $this->RencanaBiayaModel->select();
        echo json_encode($result);
    }

    function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if(!isset($data['idRencanaBiaya'])){
            $result = $this->RencanaBiayaModel->insert($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Simpan'));
            }                
        }else{
            $result = $this->RencanaBiayaModel->update($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Ubah'));
            } 
        }
    }
    
    function hapus($idRencanaBiaya)
    {
        if($this->RencanaBiayaModel->delete($idRencanaBiaya))
            echo json_encode(array('message'=>'Berhasil Hapus'));
        else{
            http_response_code(400);
            echo json_encode(array('message'=>'Gagal Simpan'));
        }
    }

}

/* End of file Controllername.php */
