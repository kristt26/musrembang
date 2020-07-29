<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RencanaKerja_model extends CI_Model {
    function select()
    {
        $tanggal = date("Y-m-d");
        $result = $this->db->query("SELECT
            `rencanakerja`.*,
            `kegiatan`.`KodeKegiatan`,
            `kegiatan`.`NamaKegiatan`,
            `bidang`.`KodeBidang`,
            `bidang`.`NamaBidang`,
            `jalan`.`jalan`,
            `rt`.`nort`,
            `transaksirenbi`.`nominal`,
            `bidangskpd`.`NamaBidangSkpd`,
            `detailrencanabiaya`.`nominal` AS `nominal1`,
            `rencanabiaya`.`NamaRencanaBiaya`,
            `transaksirenbi`.`idtransaksirenbi`,
            `detailrencanabiaya`.`iddetailrencanabiaya`,
            `rencanabiaya`.`idRencanaBiaya`,
            `bidangskpd`.`idbidangskpd`,
            `rt`.`idrt`,
            `kegiatan`.`idbidang`,
            `rw`.`norw`,
            `kelurahan`.`NamaKelurahan`
        FROM
            `rencanakerja`
            LEFT JOIN `kegiatan` ON `kegiatan`.`idKegiatan` = `rencanakerja`.`idKegiatan`
            LEFT JOIN `bidang` ON `bidang`.`idbidang` = `kegiatan`.`idbidang`
            LEFT JOIN `jalan` ON `jalan`.`idjalan` = `rencanakerja`.`idjalan`
            LEFT JOIN `rt` ON `jalan`.`idrt` = `rt`.`idrt`
            LEFT JOIN `transaksirenbi` ON `transaksirenbi`.`idRencanaKerja` =
            `rencanakerja`.`idRencanaKerja`
            LEFT JOIN `bidangskpd` ON `bidangskpd`.`idbidangskpd` =
            `transaksirenbi`.`idbidangskpd`
            LEFT JOIN `detailrencanabiaya` ON `detailrencanabiaya`.`iddetailrencanabiaya`
            = `transaksirenbi`.`iddetailrencanabiaya`
            LEFT JOIN `rencanabiaya` ON `rencanabiaya`.`idRencanaBiaya` =
            `detailrencanabiaya`.`idRencanaBiaya`
            LEFT JOIN `perioderenker` ON `perioderenker`.`idPeriodeRenker` =
            `rencanakerja`.`idPeriodeRenker`
            LEFT JOIN `rw` ON `rencanakerja`.`idrw` = `rw`.`idrw`
            LEFT JOIN `kelurahan` ON `rw`.`idKelurahan` = `kelurahan`.`idKelurahan`
        WHERE `rencanakerja`.`status`NOT IN('Draf') AND (`perioderenker`.`mulai` <= '$tanggal' AND `perioderenker`.`berakhir` >= '$tanggal')");
        return $result->result();
    }    

    public function updategambar($logo)
    {
        $result = $this->db->update('kelurahan', array('logo'=>$logo));
        return $result;
    }
    function insert($data)
    {
        $item = [
            'NamaKelurahan'=>$data['NamaKelurahan'],
            'Alamat'=>$data['Alamat'],
            'Kontak'=>$data['Kontak']
        ];
        if(!isset($data['idKelurahan'])){
            $result = $this->db->insert('kelurahan', $item);
            if($result){
                $item['idKelurahan'] = $this->db->insert_id();
                return $item;
            }else{
                return false;
            }
        }else{
            $this->db->where('idKelurahan', $data['idKelurahan']);
            $result = $this->db->update('kelurahan', $item);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
    public function validasi($data)
    {
        $this->db->set('status',  $data['setstatus']);
        $this->db->where('idRencanaKerja', $data['idRencanaKerja']);
        $result = $this->db->update('rencanakerja');
        return $result;

    }
    public function dataEdit($idRencanaKerja)
    {
        $this->load->model('admin/Skpd_model', 'SkpdModel');
        $tanggal = date("Y-m-d");
        $data = array('data' => '', 'sumberanggaran' => '', 'bidangskpd' => '');
        $result = $this->db->query("SELECT
            `rencanakerja`.*,
            `kegiatan`.`KodeKegiatan`,
            `kegiatan`.`NamaKegiatan`,
            `bidang`.`KodeBidang`,
            `bidang`.`NamaBidang`,
            `jalan`.`jalan`,
            `rt`.`nort`,
            `transaksirenbi`.`nominal`,
            `bidangskpd`.`NamaBidangSkpd`,
            `detailrencanabiaya`.`nominal` AS `nominal1`,
            `rencanabiaya`.`NamaRencanaBiaya`,
            `transaksirenbi`.`idtransaksirenbi`,
            `detailrencanabiaya`.`iddetailrencanabiaya`,
            `rencanabiaya`.`idRencanaBiaya`,
            `bidangskpd`.`idbidangskpd`,
            `rt`.`idrt`,
            `kegiatan`.`idbidang`
        FROM
            `rencanakerja`
            LEFT JOIN `kegiatan` ON `kegiatan`.`idKegiatan` = `rencanakerja`.`idKegiatan`
            LEFT JOIN `bidang` ON `bidang`.`idbidang` = `kegiatan`.`idbidang`
            LEFT JOIN `jalan` ON `jalan`.`idjalan` = `rencanakerja`.`idjalan`
            LEFT JOIN `rt` ON `jalan`.`idrt` = `rt`.`idrt`
            LEFT JOIN `transaksirenbi` ON `transaksirenbi`.`idRencanaKerja` =
            `rencanakerja`.`idRencanaKerja`
            LEFT JOIN `bidangskpd` ON `bidangskpd`.`idbidangskpd` =
            `transaksirenbi`.`idbidangskpd`
            LEFT JOIN `detailrencanabiaya` ON `detailrencanabiaya`.`iddetailrencanabiaya`
            = `transaksirenbi`.`iddetailrencanabiaya`
            LEFT JOIN `rencanabiaya` ON `rencanabiaya`.`idRencanaBiaya` =
            `detailrencanabiaya`.`idRencanaBiaya`
            LEFT JOIN `perioderenker` ON `perioderenker`.`idPeriodeRenker` =
            `rencanakerja`.`idPeriodeRenker`
        WHERE `rencanakerja`.`idRencanaKerja`='$idRencanaKerja'");
        $data['data'] = $result->result()[0];
        $result = $this->db->query("SELECT
            `detailrencanabiaya`.*,
            `rencanabiaya`.`NamaRencanaBiaya`
        FROM
            `detailrencanabiaya`
            INNER JOIN `rencanabiaya` ON `rencanabiaya`.`idRencanaBiaya` =
            `detailrencanabiaya`.`idRencanaBiaya`
            LEFT JOIN `perioderenker` ON `detailrencanabiaya`.`idPeriodeRenker` =
            `perioderenker`.`idPeriodeRenker`
        WHERE `perioderenker`.`mulai` <= '$tanggal' AND `perioderenker`.`berakhir` >= '$tanggal'");
        $data['sumberanggaran'] = $result->result();
        $data['bidangskpd'] = $this->SkpdModel->select();
        return $data;
    }
}
