<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RencanaKerja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/RencanaKerja_model', 'RencanaKerjaModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        $this->load->model('admin/Profile_Model', 'ProfileModel');
        
    }

    public function index()
    {
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja', 'tahun' => $periode[0], 'profile' => $profile, 'periode' => $periodeaktif[0]];
        $this->load->view('pimpinan/template/header', $title);
        $this->load->view('pimpinan/rencanakerja');
        $this->load->view('pimpinan/template/footer');
    }

    public function getdata()
    {
        $result = $this->RencanaKerjaModel->select();
        echo json_encode($result);
    }

    public function created()
    {
        $periode['periode'] = $this->RencanaKerjaModel->selectperiode();
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja'];
        $this->load->view('admin/template/header', $title);
        $this->load->view('admin/createdrenja', $periode);
        $this->load->view('admin/template/footer');
    }

    public function getdatacreated($idRencanaKerja=null)
    {
        if($idRencanaKerja=='created'){
            $result = $this->RencanaKerjaModel->selectdata();
            echo json_encode($result);
        }else{
            $result = $this->RencanaKerjaModel->dataEdit($idRencanaKerja);
            echo json_encode($result);
        }
    }

    public function validasi()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $result = $this->RencanaKerjaModel->validasi($data);
        echo json_encode(array('status'=>$result));
    }

    public function hapus($idRencanaKerja)
    {
        if ($this->RencanaKerjaModel->delete($idRencanaKerja)) {
            echo json_encode(array('message' => 'Berhasil Hapus'));
        } else {
            http_response_code(400);
            echo json_encode(array('message' => 'Gagal Simpan'));
        }
    }

    public function detail()
    {
        $this->load->model('user/Renja_model', 'RenjaModel');
        
        $profile = $this->ProfileModel->select();
        $periode = $this->PeriodeModel->selectarsip();
        $periodeaktif = $this->PeriodeModel->selectperiodeaktif();
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja', 'tahun' => $periode[0], 'profile' => $profile, 'periode' => $periodeaktif[0]];
        $periodee['periode'] = $this->RenjaModel->selectperiode();
        $this->load->view('pimpinan/template/header', $title);
        $this->load->view('pimpinan/detailrencanakerja', $periodee);
        $this->load->view('pimpinan/template/footer');
    }

    public function getdatadetail($idRencanaKerja = null)
    {
        
        $result = $this->RencanaKerjaModel->dataEdit($idRencanaKerja);
        echo json_encode($result);
    }

    public function upload()
    {
        $cek = $this->RencanaKerjaModel->select();
        $path_to_file = './assets/berkas/' . $cek[0]->file;
        $config['upload_path'] = './assets/berkas';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 4096;
        $config['encrypt_name'] = true;
        if ($cek[0]->file !== null && isset($_FILES['file'])) {
            if (unlink($path_to_file)) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload("file")) {
                    $data = array('upload_data' => $this->upload->data());
                    $image = $data['upload_data']['file_name'];
                    // $result = $this->ProfileModel->updategambar($image);
                    return array('file' => $image);
                }
            } else {
                return [];
            }
        } else {
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
                // $result = $this->ProfileModel->updategambar($image);
                return array('file' => $image);
            }
        }
    }
}

/* End of file Controllername.php */