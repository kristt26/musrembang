<?php

class Periode_model extends CI_Model {
    function select()
    {
        $result = $this->db->get('perioderenker');
        return $result->result();
    }

    public function selectarsip()
    {
        $tanggal = date("Y-m-d");
        $result = $this->db->query("SELECT * FROM perioderenker WHERE mulai <='$tanggal'");
        return $result->result();
    }

    function insert($data)
    {
        $item= [
            'Tahun'=>$data['Tahun'],
            'mulai'=>$data['mulai'],
            'berakhir'=>$data['berakhir']
        ];
        // $this->db->update('perioderenker', array('Status'=>'Tidak Aktif'));
        $result = $this->db->insert('perioderenker', $item);
        $item['idPeriodeRenker'] = $this->db->insert_id();
        if($result)
            return $item;
        else
            return false;
    }

    function update($data)
    {
        $item= [
            'Tahun'=>$data['Tahun'],
            'mulai'=>$data['mulai'],
            'berakhir'=>$data['berakhir']
        ];
        $this->db->where('idPeriodeRenker', $data['idPeriodeRenker']);
        if($this->db->update('perioderenker', $item))
            return $data;
        else
            return false;
    }
    function delete($idPeriodeRenker)
    {
        $this->db->where('idPeriodeRenker', $idPeriodeRenker);
        if($this->db->delete('perioderenker'))
            return true;
        else
            return false;
    }    
}
