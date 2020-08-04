<?php

class Laporan_model extends CI_Model
{
    public function AmbilLaporan($idPeriode)
    {
        // $result = $this->db->get('bidang');
        // $bidang = $result->result();
        $result = $this->db->query("SELECT
                `kegiatan`.*,
                `bidang`.`KodeBidang`,
                `bidang`.`NamaBidang`
            FROM
                `kegiatan`
                LEFT JOIN `bidang` ON `kegiatan`.`idbidang` = `bidang`.`idbidang`");
        $kegiatans = $result->result();
        foreach ($kegiatans as $kegiatan) {
            $result = $this->db->query("SELECT
                    `rencanakerja`.`idRencanaKerja`,
                    `rencanakerja`.`permasalahan`,
                    `rencanakerja`.`status`,
                    `rencanakerja`.`volume`,
                    `rencanakerja`.`satuan`,
                    `rencanakerja`.`prioritas`,
                    `rencanakerja`.`file`,
                    `rencanakerja`.`idKegiatan`,
                    `rw`.`idrw`,
                    `rw`.`norw`,
                    `jalan`.`idjalan`,
                    `jalan`.`jalan`,
                    `jalan`.`lat`,
                    `jalan`.`long`,
                    `rt`.`idrt`,
                    `rt`.`nort`,
                    `transaksirenbi`.`idtransaksirenbi`,
                    `transaksirenbi`.`nominal`,
                    `bidangskpd`.`idbidangskpd`,
                    `bidangskpd`.`NamaBidangSkpd`,
                    `detailrencanabiaya`.`iddetailrencanabiaya`,
                    -- `detailrencanabiaya`.`nominal` AS `nominal1`,
                    `rencanabiaya`.`idRencanaBiaya`,
                    `rencanabiaya`.`NamaRencanaBiaya`,
                    `perioderenker`.`idPeriodeRenker`,
                    `perioderenker`.`Tahun`,
                    `perioderenker`.`mulai`,
                    `perioderenker`.`berakhir`
                FROM
                    `rencanakerja`
                    LEFT JOIN `jalan` ON `jalan`.`idjalan` = `rencanakerja`.`idjalan`
                    LEFT JOIN `rt` ON `rt`.`idrt` = `jalan`.`idrt`
                    LEFT JOIN `rw` ON `rw`.`idrw` = `rencanakerja`.`idrw`
                    LEFT JOIN `transaksirenbi` ON `rencanakerja`.`idRencanaKerja` =
                    `transaksirenbi`.`idRencanaKerja`
                    LEFT JOIN `bidangskpd` ON `bidangskpd`.`idbidangskpd` =
                    `transaksirenbi`.`idbidangskpd`
                    LEFT JOIN `detailrencanabiaya` ON `transaksirenbi`.`iddetailrencanabiaya` =
                    `detailrencanabiaya`.`iddetailrencanabiaya`
                    LEFT JOIN `rencanabiaya` ON `rencanabiaya`.`idRencanaBiaya` =
                    `detailrencanabiaya`.`idRencanaBiaya`
                    LEFT JOIN `perioderenker` ON `rencanakerja`.`idPeriodeRenker` =
                    `perioderenker`.`idPeriodeRenker`
                WHERE `perioderenker`.`idPeriodeRenker` = '$idPeriode' AND `rencanakerja`.`idKegiatan` = '$kegiatan->idKegiatan'");
            $kegiatan->rencanakerja = $result->result();
        }
        return $kegiatans;
        // $query = $this->db->query("SELECT
        //     `pemesanan`.`kd_pemesanan`,
        //     `pemesanan`.`tgl_pemesanan`,
        //     `pemesanan`.`kd_pelanggan`,
        //     `pemesanan`.`status`,
        //     `transaksi`.`id_pemesanan`,
        //     `transaksi`.`kd_transaksi`,
        //     `transaksi`.`kd_pegawai`,
        //     `transaksi`.`tgl_ambil`,
        //     `transaksi`.`jenis_type`,
        //     `transaksi`.`berat`,
        //     `transaksi`.`jumlah`,
        //     `pelanggan`.`nama`,
        //     `pelanggan`.`kd_pelanggan` AS `kd_pelanggan1`,
        //     `pelanggan`.`alamat`,
        //     `pelanggan`.`no_hp`,
        //     `pelanggan`.`jk`,
        //     `pelanggan`.`iduser`
        // FROM
        //     `transaksi`
        //     LEFT JOIN `pemesanan` ON `pemesanan`.`id` = `transaksi`.`id_pemesanan`
        //     LEFT JOIN `pelanggan` ON `pelanggan`.`kd_pelanggan` =
        //     `pemesanan`.`kd_pelanggan`
        // WHERE tgl_ambil >= '$tglawal' AND tgl_ambil<='$tglakhir'");
        // return $query->result();
    }
    public function select()
    {
        $data = ['transaksi' => array(), 'pemesanan' => array()];
        $query = $this->db->query("SELECT
            `pemesanan`.`kd_pemesanan`,
            `pemesanan`.`tgl_pemesanan`,
            `pemesanan`.`kd_pelanggan`,
            `pemesanan`.`status`,
            `transaksi`.`id_pemesanan`,
            `transaksi`.`kd_transaksi`,
            `transaksi`.`kd_pegawai`,
            `transaksi`.`tgl_ambil`,
            `transaksi`.`jenis_type`,
            `transaksi`.`berat`,
            `transaksi`.`jumlah`,
            `pelanggan`.`nama`,
            `pelanggan`.`kd_pelanggan` AS `kd_pelanggan1`,
            `pelanggan`.`alamat`,
            `pelanggan`.`no_hp`,
            `pelanggan`.`jk`,
            `pelanggan`.`iduser`
        FROM
            `transaksi`
            LEFT JOIN `pemesanan` ON `pemesanan`.`id` = `transaksi`.`id_pemesanan`
            LEFT JOIN `pelanggan` ON `pelanggan`.`kd_pelanggan` =
            `pemesanan`.`kd_pelanggan`");
        $data['transaksi'] = $query->result();

        $query = $this->db->query("SELECT
            `pemesanan`.*
        FROM
            `pemesanan`
            LEFT JOIN `transaksi` ON `transaksi`.`id_pemesanan` = `pemesanan`.`id`
        WHERE
            `transaksi`.`id_pemesanan` IS NULL AND pemesanan.status NOT IN('Selesai','Batal')");
        $data['pemesanan'] = $query->result();
        return $data;
    }

    public function insert($data)
    {
        $itemtrans = [
            'id_pemesanan' => $data['id'],
            'kd_pegawai' => $this->session->userdata('kd_pegawai'),
            'tgl_ambil' => $data['tgl_ambil'],
            'jenis_type' => $data['jenis_type'],
            'berat' => $data['berat'],
            'jumlah' => $data['jumlah'],
        ];
        $itempem = [
            'status' => 'Selesai',
        ];
        $this->db->trans_begin();
        $this->db->insert('transaksi', $itemtrans);
        $this->db->where('id', $data['id']);
        $this->db->update('pemesanan', $itempem);
        if ($this->db->trans_status() == true) {
            $this->db->trans_commit();
            return true;
        } else {
            $this->db->trans_rollback();
            return false;
        }
    }

    public function update($data)
    {
        $itemtrans = [
            'kd_pegawai' => $this->session->userdata('kd_pegawai'),
            'tgl_ambil' => $data['tgl_ambil'],
            'jenis_type' => $data['jenis_type'],
            'berat' => $data['berat'],
            'jumlah' => $data['jumlah'],
        ];
        $this->db->where('kd_transaksi', $data['kd_transaksi']);
        $result = $this->db->update('transaksi', $itemtrans);
        return $result;
    }
    public function delete($kd_transaksi)
    {
        $this->db->where('kd_transaksi', $kd_transaksi);
        $result = $this->db->delete('transaksi');
        return $result;
    }
}
