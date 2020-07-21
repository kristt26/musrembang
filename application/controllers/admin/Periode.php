<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Periode_model', 'PeriodeModel');
    }

    public function index()
    {
        $title['title'] = ['header'=>'Periode Rencana Kerja', 'dash'=>'Periode'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/periode');
        $this->load->view('admin/template/footer');
    }

    function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if(!isset($data['idPeriodeRenker'])){
            $result = $this->PeriodeModel->insert($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Simpan'));
            }                
        }else{
            $result = $this->PeriodeModel->update($data);
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
        $result = $this->PeriodeModel->select();
        echo json_encode($result);
    }

    function hapus($idPeriodeRenker)
    {
        if($this->PeriodeModel->delete($idPeriodeRenker))
            echo json_encode(array('message'=>'Berhasil Hapus'));
        else{
            http_response_code(400);
            echo json_encode(array('message'=>'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
