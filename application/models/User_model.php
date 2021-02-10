<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function select($data)
    {
        $item = array('username' => $data['username'], 'password' => md5($data['password']));
        $result = $this->db->get_where('user', $item);
        if ($result->num_rows() > 0) {
            $user = $result->result()[0];
            if ($user->akses == "admin" || $user->akses == "pimpinan") {
                $datauser = $this->db->get_where('pegawai', array('iduser' => $user->iduser))->result_array()[0];
                $datauser['akses'] = $user->akses;
                return $datauser;
            } else {
                $datauser = $this->db->get_where('rw', array('iduser' => $user->iduser))->result_array()[0];
                $datauser['akses'] = $user->akses;
                return $datauser;
            }
        } else {
            return $result->result();
        }

    }

    public function check()
    {
        $result = $this->db->get('user')->result();
        if(count($result)==0){
            $this->db->trans_begin();
            $user = [
                'username' => 'admin',
                'password' => md5('admin'),
                'akses' => 'admin',
                'status' => 'Aktif'
            ];
            $this->db->insert('user', $user);
            $userid = $this->db->insert_id();
            $pegawai = [
                'nama' => 'Admin',
                'kontak' => '-',
                'alamat' => '-',
                'jabatan' => '-',
                'email' => 'admin@mail.com',
                'iduser' => $userid,
            ];
            $this->db->insert('user');
        }
    }
}
