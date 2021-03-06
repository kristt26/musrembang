<?php

class Pegawai_model extends CI_Model {
    function select()
    {
        $result = $this->db->query("SELECT
            `pegawai`.*,
            `user`.`username`,
            `user`.`status`
        FROM
            `pegawai`
            LEFT JOIN `user` ON `user`.`iduser` = `pegawai`.`iduser`");
        return $result->result();
    }

    function insert($data)
    {
        $item= [
            'nama'=>$data['nama'],
            'kontak'=>$data['kontak'],
            'alamat'=>$data['alamat'],
            'jabatan'=>$data['jabatan'],
            'email'=>$data['email']
        ];
        $user= [
            'username'=>$data['username'],
            'password'=>md5($data['password']),
            'status'=>'Aktif'
        ];
        $this->db->trans_begin();
        $this->db->insert('user', $user);
        $item['iduser'] = $this->db->insert_id();
        $this->db->insert('pegawai', $item);
        $item['idpegawai'] = $this->db->insert_id();
        if($this->db->trans_status()==true){
            $this->db->trans_commit();
            return $item;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }

    function update($data)
    {
        $item= [
            'nama'=>$data['nama'],
            'kontak'=>$data['kontak'],
            'alamat'=>$data['alamat'],
            'jabatan'=>$data['jabatan'],
            'email'=>$data['email']
        ];
        $this->db->where('idpegawai', $data['idpegawai']);
        if($this->db->update('pegawai', $item))
            return true;
        else
            return false;
    }
    function delete($idpegawai)
    {
        $this->db->where('idpegawai', $idpegawai);
        if($this->db->delete('pegawai'))
            return true;
        else
            return false;
    }    
}

/* End of file ModelName.php */
