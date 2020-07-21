<?php

class Bidang_model extends CI_Model {
    function select()
    {
        $result = $this->db->get('bidang');
        $bidang = $result->result();
        $result = $this->db->get('kegiatan');
        $kegiatan = $result->result();
        foreach ($bidang as $key => $value) {
            $item['item']=array();
            foreach ($kegiatan as $key => $value1) {
                if($value1->idbidang == $value->idbidang)
                    array_push($item['item'], $value1);
            }
            $value->kegiatan = $item['item'];
        }
        return $bidang;
    }
    function insert($data)
    {
        $item = [
            'KodeBidang'=>$data['KodeBidang'],
            'NamaBidang'=>$data['NamaBidang']
        ];
        if($this->db->insert('bidang', $item)){
            $item['idbidang'] = $this->db->insert_id();
            return (object)$item;
        }
        else
            return false;
    }
    function update($data)
    {
        $item = [
            'KodeBidang'=>$data['KodeBidang'],
            'NamaBidang'=>$data['NamaBidang']
        ];
        $this->db->where('idbidang', $data['idbidang']);
        if($this->db->update('bidang', $item))
            return (object)$item;
        else
            return false;
    }
    function delete($idbidang)
    {
        $this->db->where('idbidang', $idbidang);
        if($this->db->delete('bidang'))
            return true;
        else
            return false;
    }    
}