<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Renja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user/Renja_model', 'RenjaModel');
        $this->load->model('admin/Periode_model', 'PeriodeModel');
        
    }

    public function index()
    {
        $periode = $this->PeriodeModel->selectarsip();
        $title['title'] = ['header' => 'Rencana Kerja', 'dash' => 'Rencana Kerja', 'tahun'=>$periode];
        $this->load->view('user/template/header', $title);
        $this->load->view('user/renja');
        $this->load->view('user/template/footer');
    }

    public function simpan()
    {
        $data = $_POST;
        $a = $this->upload($data['idRencanaKerja']);
        if (count($a) > 0) {
            $data['file'] = $a['file'];
        }

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

    public function getdatacreated($idRencanaKerja=null)
    {
        if($idRencanaKerja=='created'){
            $result = $this->RenjaModel->selectdata();
            echo json_encode($result);
        }else{
            $result = $this->RenjaModel->dataEdit($idRencanaKerja);
            echo json_encode($result);
        }
    }

    public function validasi()
    {
        $data = json_decode($this->security->xss_clean($this->input->raw_input_stream), true);
        $result = $this->RenjaModel->validasi($data);
        echo json_encode($result);
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

    public function upload($idRencanaKerja)
    {
        $cek = $this->RenjaModel->select();
        $nilai;
        foreach ($cek as $key => $value) {
            if($value->idRencanaKerja==$idRencanaKerja)
                $nilai = $value;
        }
        $path_to_file = './assets/berkas/' . $nilai->file;
        $config['upload_path'] = './assets/berkas';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 4096;
        $config['encrypt_name'] = true;
        if(isset($_FILES['file'])){
            if ($nilai->file !== null) {
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
        }else{
            return array('file' => $nilai->file);
        }
    }
}

/* End of file Controllername.php */
