<?php

class Renja_model extends CI_Model
{
    public function select()
    {
        $result = $this->db->get('rencanabiaya');
        return $result->result();
    }

    public function insert($data)
    {
        $item = [
            'NamaRencanaBiaya' => $data['NamaRencanaBiaya'],
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
            'NamaRencanaBiaya' => $data['NamaRencanaBiaya'],
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
