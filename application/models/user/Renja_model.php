<?php

class Renja_model extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/RencanaBiaya_model', 'RencanaBiayaModel');
        $this->load->model('admin/Skpd_model', 'SkpdModel');
    }

    public function getfile($idRencanaKerja)
    {
        $result = $this->db->get_where('rencanakerja', array('idRencanaKerja'=>$idRencanaKerja));
        return $result->result()[0];
    }
    
    public function select()
    {
        $tanggal = date("Y-m-d");
        $idrw = $this->session->userdata('idrw');
        $this->session->userdata('item');
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
        WHERE `rencanakerja`.`idrw`='$idrw' AND (`perioderenker`.`mulai` <= '$tanggal' AND `perioderenker`.`berakhir` >= '$tanggal')");
        return $result->result();
    }

    public function selectdata()
    {
        $tanggal = date("Y-m-d");
        $idrw = $this->session->userdata('idrw');
        $data = array('kegiatan'=>'', 'lingkungan'=>'', 'sumberanggaran'=>'', 'bidangskpd'=>'');
        $result = $this->db->query("SELECT
            `kegiatan`.*,
            `bidang`.`KodeBidang`,
            `bidang`.`NamaBidang`
        FROM
            `kegiatan`
            LEFT JOIN `bidang` ON `bidang`.`idbidang` = `kegiatan`.`idbidang`
        ORDER BY
            `bidang`.`NamaBidang`, kegiatan.NamaKegiatan");
        $data['kegiatan']= $result->result();

        $result = $this->db->get_where('rt', array('idrw'=>$idrw));
        $RT = $result->result();
        foreach ($RT as $value) {
            $result = $this->db->get_where('jalan', array('idrt'=>$value->idrt));
            $value->jalan = $result->result();
        }
        $data['lingkungan']= $RT;
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

    public function selectperiode()
    {
        $tanggal = date("Y-m-d");
        $result = $this->db->query("SELECT * FROM perioderenker WHERE mulai <='$tanggal' AND berakhir>='$tanggal'");
        return $result->result()[0];
    }

    public function insert($data)
    {
        $this->db->trans_begin();
        if(isset($data['file'])){
            $item = [
                'idPeriodeRenker' => $data['idPeriodeRenker'],
                'idKegiatan' => $data['idKegiatan'],
                'idjalan' => $data['idjalan'],
                'permasalahan' => $data['permasalahan'],
                'status' => 'Draf',
                'prioritas' => $data['prioritas'],
                'volume' => $data['volume'],
                'satuan' => $data['satuan'],
                'idrw' => $this->session->userdata('idrw'),
                'file' => $data['file']
            ];
        }else{
            $item = [
                'idPeriodeRenker' => $data['idPeriodeRenker'],
                'idKegiatan' => $data['idKegiatan'],
                'idjalan' => $data['idjalan'],
                'permasalahan' => $data['permasalahan'],
                'status' => 'Draf',
                'prioritas' => $data['prioritas'],
                'volume' => $data['volume'],
                'satuan' => $data['satuan'],
                'idrw' => $this->session->userdata('idrw')
            ];
        }
        

        $result = $this->db->insert('rencanakerja', $item);
        $data['idRencanaKerja'] = $this->db->insert_id();
        $data['idrw'] = $this->session->userdata('idrw');
        $item = [
            'nominal' => $data['nominal'],
            'idRencanaKerja' => $data['idRencanaKerja'],
            'idbidangskpd' => $data['idbidangskpd'],
            'iddetailrencanabiaya' => $data['iddetailrencanabiaya'],
        ];
        $result = $this->db->insert('transaksirenbi', $item);
        $data['idtransaksirenbi'] = $this->db->insert_id();
        if ($this->db->trans_status()==true) {
            $this->db->trans_commit();
            return $data;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function update($data)
    {
        $this->db->trans_begin();
        $item = [
            'idKegiatan' => $data['idKegiatan'],
            'idjalan' => $data['idjalan'],
            'permasalahan' => $data['permasalahan'],
            'status' => 'Draf',
            'prioritas' => $data['prioritas'],
            'lokasi' => $data['lokasi'],
            'volume' => $data['volume'],
            'satuan' => $data['satuan'],
        ];
        $this->db->where('idRencanaKerja', $data['idRencanaKerja']);
        $this->db->update('rencanakerja', $item);
        $item = [
            'nominal' => $data['nominal'],
            'idRencanaKerja' => $data['idRencanaKerja'],
            'idbidangskpd' => $data['idbidangskpd'],
            'iddetailrencanabiaya' => $data['iddetailrencanabiaya'],
        ];
        $this->db->where('idtransaksirenbi', $data['idtransaksirenbi']);
        $this->db->update('transaksirenbi', $item);
        if ($this->db->trans_status()==true) {
            $this->db->trans_commit();
            return $data;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
    public function delete($idRencanaBiaya, $idtransaksirenbi)
    {
        $this->db->trans_begin();
        $this->db->where('idRencanaKerja', $idRencanaKerja);
        $this->db->delete('RencanaKerja');
        $this->db->where('idtransaksirenbi', $idtransaksirenbi);
        $this->db->delete('transaksirenbi');
        if ($this->db->trans_status()==true) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }
}
