<?php

class Rt_model extends CI_Model {
    function select($idrw)
    {
        $data=array('rw'=>'', 'rt'=>'');
        $result = $this->db->get_where('rw', array('idrw'=>$idrw));
        $data['rw'] = $result->result()[0];
        $result = $this->db->get('rt');
        $rt = $result->result();
        foreach ($rt as $value) {
            $result = $this->db->get_where('jalan', array('idrt'=>$value->idrt));
            $value->jalan = $result->result();
        }
        $data['rt'] = $rt;
        return $data;
    }

    function insert($data)
    {
        $item= [
            'nort'=>$data['nort'],
            'pejabatrt'=>$data['pejabatrt'],
            'email'=>$data['email'],
            'idrw'=>$data['idrw']
        ];
        $result = $this->db->insert('rt', $item);
        $item['idrt'] = $this->db->insert_id();
        $item['jalan'] = [];
        if($result)
            return $item;
        else
            return false;
    }

    function insertjalan($data)
    {
        $item= [
            'jalan'=>$data['jalan'],
            'idrt'=>$data['idrt']
        ];
        $result = $this->db->insert('jalan', $item);
        $item['idjalan'] = $this->db->insert_id();
        if($result)
            return $item;
        else
            return false;
    }

    function updatejalan($data)
    {
        $item= [
            'jalan'=>$data['jalan'],
        ];
        $this->db->where('idjalan', $data['idjalan']);
        if($this->db->update('jalan', $item))
            return $data;
        else
            return false;
    }

    function update($data)
    {
        $item= [
            'nort'=>$data['nort'],
            'pejabatrt'=>$data['pejabatrt'],
            'email'=>$data['email'],
            'idrw'=>$data['idrw']
        ];
        $this->db->where('idrt', $data['idrt']);
        if($this->db->update('rt', $item))
            return $data;
        else
            return false;
    }
    function delete($idrt)
    {
        $this->db->where('idrt', $idrt);
        if($this->db->delete('rt'))
            return true;
        else
            return false;
    }    
}
