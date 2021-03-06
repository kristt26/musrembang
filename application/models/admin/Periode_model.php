<?php

class Periode_model extends CI_Model
{
    public function select()
    {
        $result = $this->db->query("SELECT * FROM perioderenker ORDER BY tahun DESC");
        return $result->result();
    }

    public function selectarsip()
    {
        $tanggal = date("Y-m-d");
        $result = $this->db->query("SELECT * FROM perioderenker WHERE berakhir <='$tanggal' ORDER BY tahun DESC");
        // $result = $this->db->query("SELECT * FROM perioderenker WHERE `perioderenker`.`mulai` <= '$tanggal' AND `perioderenker`.`berakhir` >= '$tanggal'");
        return $result->result();
    }

    public function selectperiodeaktif()
    {
        $tanggal = date("Y-m-d");
        $result = $this->db->query("SELECT * FROM perioderenker WHERE `perioderenker`.`mulai` <= '$tanggal' AND `perioderenker`.`berakhir` >= '$tanggal'");
        return $result->result()[0];
    }
    public function selectperiodebyid($id = null)
    {
        $result = $this->db->query("SELECT * FROM perioderenker WHERE `perioderenker`.`idPeriodeRenker` = '$id'");
        return $result->result()[0];
    }

    public function insert($data)
    {
        $item = [
            'Tahun' => $data['Tahun'],
            'mulai' => $data['mulai'],
            'berakhir' => $data['berakhir'],
        ];
        // $this->db->update('perioderenker', array('Status'=>'Tidak Aktif'));
        $result = $this->db->insert('perioderenker', $item);
        $item['idPeriodeRenker'] = $this->db->insert_id();
        if ($result) {
            return $item;
        } else {
            return false;
        }

    }

    public function update($data)
    {
        $item = [
            'Tahun' => $data['Tahun'],
            'mulai' => $data['mulai'],
            'berakhir' => $data['berakhir'],
        ];
        $this->db->where('idPeriodeRenker', $data['idPeriodeRenker']);
        if ($this->db->update('perioderenker', $item)) {
            return $data;
        } else {
            return false;
        }

    }
    public function delete($idPeriodeRenker)
    {
        $this->db->where('idPeriodeRenker', $idPeriodeRenker);
        if ($this->db->delete('perioderenker')) {
            return true;
        } else {
            return false;
        }

    }
}
