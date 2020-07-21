<?php
class Kegiatan_model extends CI_Model {

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
            'KodeKegiatan'=>$data['KodeKegiatan'],
            'NamaKegiatan'=>$data['NamaKegiatan'],
            'idbidang'=>$data['idbidang'],
        ];
        if($this->db->insert('kegiatan', $item))
        {
            $item['idKegiatan'] = $this->db->insert_id();
            return (object)$item;
        }
        else
        {
            return false;
        }
    }
    function update($data)
    {
        $item = [
            'KodeKegiatan'=>$data['KodeKegiatan'],
            'NamaKegiatan'=>$data['NamaKegiatan'],
            'idbidang'=>$data['idbidang'],
        ];
        $this->db->where('idKegiatan', $data['idKegiatan']);
        if($this->db->update('kegiatan', $item))
            return (object)$item;
        else
            return false;
    }
    function delete($idKegiatan)
    {
        $this->db->where('idKegiatan', $idKegiatan);
        if($this->db->delete('kegiatan'))
            return true;
        else
            return false;
    }    
}

/* End of file ModelName.php */
