<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaranbiaya1 extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/AnggaranBiaya_model', 'AnggaranBiayaModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_model', 'ProfileModel');
    }

    public function index($idPeriodeRenker= null)
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        $title['title'] = ['header'=>'Musrenbang | Anggaran Biaya', 'dash'=>'Periode', 'tahun'=>$periode, 'profile'=>$profile, 'periode'=>$periodeaktif[0]];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/anggaranbiaya');
        $this->load->view('admin/template/footer');
    }

    function simpan()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        if(!isset($data['iddetailrencanabiaya'])){
            $result = $this->AnggaranBiayaModel->insert($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Simpan'));
            }                
        }else{
            $result = $this->AnggaranBiayaModel->update($data);
            if($result !== false)
                echo json_encode($result);
            else{
                http_response_code(400);
                echo json_encode(array('message'=>'Gagal Ubah'));
            } 
        }
    }

    public function getdata($idPeriodeRenker= null)
    {
        $result = $this->AnggaranBiayaModel->select($idPeriodeRenker);
        echo json_encode($result);
    }

    function hapus($iddetailrencanabiaya)
    {
        if($this->AnggaranBiayaModel->delete($iddetailrencanabiaya))
            echo json_encode(array('message'=>'Berhasil Hapus'));
        else{
            http_response_code(400);
            echo json_encode(array('message'=>'Gagal Simpan'));
        }
    }
}

/* End of file Controllername.php */
