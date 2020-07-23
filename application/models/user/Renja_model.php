<?php

class Renja_model extends CI_Model
{
    public function select()
    {
        $idrw = $this->session->userdata('idrw');
        $this->session->userdata('item');
        $result = $this->db->query("SELECT
            `rencanakerja`.*,
            `kegiatan`.`KodeKegiatan`,
            `kegiatan`.`NamaKegiatan`,
            `kegiatan`.`idbidang`,
            `bidang`.`KodeBidang`,
            `bidang`.`NamaBidang`
        FROM
            `rencanakerja`
            LEFT JOIN `kegiatan` ON `kegiatan`.`idKegiatan` = `rencanakerja`.`idKegiatan`
            LEFT JOIN `bidang` ON `bidang`.`idbidang` = `kegiatan`.`idbidang`
        WHERE `rencanakerja`.`idrw`='$idrw'");
        return $result->result();
    }

    public function insert($data)
    {
        $item = [
            'idPeriodeRenker' => $data['idPeriodeRenker'],
            'idKegiatan' => $data['idKegiatan'],
            'target' => $data['target'],
            'lokasi' => $data['lokasi'],
            'volume' => $data['volume'],
            'satuan' => $data['satuan'],
            'idrw' => $this->session->userdata('idrw'),
        ];

        $result = $this->db->insert('rencanabiaya', $item);
        $item['idRencanaBiaya'] = $this->db->insert_id();
        if ($result) {
            return $item;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $item = [
            'idKegiatan' => $data['idKegiatan'],
            'target' => $data['target'],
            'lokasi' => $data['lokasi'],
            'volume' => $data['volume'],
            'satuan' => $data['satuan'],
        ];
        $this->db->where('idRencanaBiaya', $data['idRencanaBiaya']);
        if ($this->db->update('rencanabiaya', $item)) {
            return $data;
        } else {
            return false;
        }
    }
    public function delete($idRencanaBiaya)
    {
        $this->db->where('idRencanaBiaya', $idRencanaBiaya);
        if ($this->db->delete('rencanabiaya')) {
            return true;
        } else {
            return false;
        }

    }
}
