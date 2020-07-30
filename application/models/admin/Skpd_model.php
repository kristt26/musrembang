<?php

class Skpd_model extends CI_Model {
    function select()
    {
        $result = $this->db->get('bidangskpd');
        return $result->result();
    }

    function insert($data)
    {
        $item= [
            'NamaBidangSkpd'=>$data['NamaBidangSkpd']
        ];
        
        $result = $this->db->insert('bidangskpd', $item);
        $item['idbidangskpd'] = $this->db->insert_id();
        if($result)
            return $item;
        else
            return false;
    }

    function update($data)
    {
        $item= [
            'NamaBidangSkpd'=>$data['NamaBidangSkpd']
        ];
        $this->db->where('idbidangskpd', $data['idbidangskpd']);
        if($this->db->update('bidangskpd', $item))
            return $data;
        else
            return false;
    }
    function delete($idbidangskpd)
    {
        $this->db->where('idbidangskpd', $idbidangskpd);
        if($this->db->delete('bidangskpd'))
            return true;
        else
            return false;
    }    
}

/* End of file ModelName.php */
