<?php

class Home_model extends CI_Model
{

    public function select($id = null)
    {
        if ($id == null) {
            $string = "";
        } else {
            $string = "perioderenker.idperiodeRenker=$id AND";
        }

        $data = $this->db->query("SELECT
            `rw`.*,
            (select count(idrt) from rt where rt.idrw=rw.idrw) as totalrt,
            (select count(idRencanaKerja) from rencanakerja where rencanakerja.idrw=rw.idrw) as totalrencanakerja,
            (select count(idRencanaKerja) from rencanakerja where rencanakerja.idrw=rw.idrw AND rencanakerja.status ='Disetujui') as totaldisetujui,
            (select count(idRencanaKerja) from rencanakerja where rencanakerja.idrw=rw.idrw AND rencanakerja.status ='Batal') as totalbatal,
            (select sum(nominal) from transaksirenbi where `rencanakerja`.`idRencanaKerja` = `transaksirenbi`.`idRencanaKerja` And rencanakerja.idrw=rw.idrw AND rencanakerja.status ='Disetujui') as totalanggaran

        FROM
            `rw`
            LEFT JOIN `rt` ON `rt`.`idrw` = `rw`.`idrw`
            LEFT JOIN `rencanakerja` ON `rw`.`idrw` = `rencanakerja`.`idrw`
            LEFT JOIN `transaksirenbi` ON `rencanakerja`.`idRencanaKerja` =
            `transaksirenbi`.`idRencanaKerja`
        GROUP BY
            `rw`.`idrw`")->result();
        $tanggal = date("Y-m-d");
        foreach ($data as $key => $value) {
            $result = $this->db->query("SELECT
                `rencanakerja`.*,
                `perioderenker`.`Tahun`,
                `perioderenker`.`mulai`,
                `perioderenker`.`berakhir`,
                `transaksirenbi`.`nominal`,
                `kegiatan`.`NamaKegiatan`,
                `jalan`.`jalan`
            FROM
                `rencanakerja`
                LEFT JOIN `perioderenker` ON `rencanakerja`.`idPeriodeRenker` =
                `perioderenker`.`idPeriodeRenker`
                LEFT JOIN `transaksirenbi` ON `transaksirenbi`.`idRencanaKerja` =
                `rencanakerja`.`idRencanaKerja`
                LEFT JOIN `kegiatan` ON `rencanakerja`.`idKegiatan` = `kegiatan`.`idKegiatan`
                LEFT JOIN `jalan` ON `rencanakerja`.`idjalan` = `jalan`.`idjalan`
            WHERE $string `perioderenker`.`mulai` < '$tanggal' AND `perioderenker`.`berakhir` > '$tanggal' AND `rencanakerja`.`idrw` = '$value->idrw'")->result();
            $value->kegiatan = $result;
            $value->totalanggaran = 0;
        }
        return $data;
    }
}
