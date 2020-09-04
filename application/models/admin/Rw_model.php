<?php

class Rw_model extends CI_Model {
    function select()
    {
        $result = $this->db->query("SELECT
            `rw`.*,
            `user`.`iduser`,
            `user`.`username`,
            `user`.`status`
        FROM
            `rw`
            LEFT JOIN `user` ON `user`.`iduser` = `rw`.`iduser`");
        return $result->result();
    }

    function insert($data)
    {
        $item= [
            'norw'=>$data['norw'],
            'idKelurahan'=>1,
            'pejabatrw'=>$data['pejabatrw'],
            'email'=>$data['email']
        ];
        $user= [
            'username'=>$data['username'],
            'password'=>md5($data['password']),
            'akses'=>'user',
            'status'=>'Aktif'
        ];
        $this->db->trans_begin();
        $this->db->insert('user', $user);
        $item['iduser'] = $this->db->insert_id();
        $this->db->insert('rw', $item);
        $item['idrw'] = $this->db->insert_id();
        $item['username'] = $data['username'];
        $item['status'] = 'Aktif';
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
        $this->db->trans_begin();
        $item= [
            'norw'=>$data['norw'],
            'pejabatrw'=>$data['pejabatrw'],
            'email'=>$data['email']
        ];
        $this->db->where('idrw', $data['idrw']);
        $this->db->update('rw', $item);
        $item= [
            'username'=>$data['username'],
            'password'=>md5($data['password'])
        ];
        $this->db->where('iduser', $data['iduser']);
        $this->db->update('user', $item);
        if($this->db->trans_status()==true){
            $this->db->trans_commit();
            return true;
        }
        else{
            $this->db->trans_rollback();
            return false;
        }
            
    }
    function delete($idrw)
    {
        $this->db->where('idrw', $idrw);
        if($this->db->delete('rw'))
            return true;
        else
            return false;
    }    
}

/* End of file ModelName.php */
