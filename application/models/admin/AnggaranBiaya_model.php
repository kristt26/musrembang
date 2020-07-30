<?php

class AnggaranBiaya_model extends CI_Model {
    function select($idPeriodeRenker)
    {
        $data=array('detailrencanabiaya'=>array(), 'rencanabiaya'=>array(), 'periode'=> "");
        $result = $this->db->get_where('perioderenker', array('idPeriodeRenker'=>$idPeriodeRenker));
        $data['periode']= $result->result()[0];
        $result = $this->db->query("SELECT
            `detailrencanabiaya`.*,
            `perioderenker`.`Tahun`,
            `rencanabiaya`.`NamaRencanaBiaya`
        FROM
            `detailrencanabiaya`
            LEFT JOIN `perioderenker` ON `detailrencanabiaya`.`idPeriodeRenker` =
            `perioderenker`.`idPeriodeRenker`
            LEFT JOIN `rencanabiaya` ON `rencanabiaya`.`idRencanaBiaya` =
            `detailrencanabiaya`.`idRencanaBiaya`
        WHERE `detailrencanabiaya`.`idPeriodeRenker` = '$idPeriodeRenker'");
        $data['detailrencanabiaya']= $result->result();
        $result = $this->db->get('rencanabiaya');
        $data['rencanabiaya']= $result->result();
        return $data;
    }

    function insert($data)
    {
        $item= [
            'idRencanaBiaya'=>$data['idRencanaBiaya'],
            'idPeriodeRenker'=>$data['idPeriodeRenker'],
            'nominal'=>$data['nominal']
        ];
        $result = $this->db->insert('detailrencanabiaya', $item);
        $data['iddetailrencanabiaya'] = $this->db->insert_id();
        if($result)
            return $data;
        else
            return false;
    }

    function update($data)
    {
        $item= [
            'idRencanaBiaya'=>$data['idRencanaBiaya'],
            'idPeriodeRenker'=>$data['idPeriodeRenker'],
            'nominal'=>$data['nominal']
        ];
        $this->db->where('iddetailrencanabiaya', $data['iddetailrencanabiaya']);
        if($this->db->update('detailrencanabiaya', $item))
            return $data;
        else
            return false;
    }
    function delete($iddetailrencanabiaya)
    {
        $this->db->where('iddetailrencanabiaya', $iddetailrencanabiaya);
        if($this->db->delete('detailrencanabiaya'))
            return true;
        else
            return false;
    }    
}
