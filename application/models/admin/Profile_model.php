<?php

class Profile_Model extends CI_Model {
    function select()
    {
        $result = $this->db->get('kelurahan');
        if($result->num_rows()>0)
            return $result->result()[0];
        else
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
}
