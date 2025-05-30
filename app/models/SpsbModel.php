<?php

class SpsbModel {
   private $table = 'spsb';
   private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllSpsb() {
        $query = 'SELECT 
                    spsb.id AS id,  
                    spsb.nama AS nama, 
                    spsb.alamat AS alamat, 
                    spsb.no_pencatatan AS no_pencatatan,
                    konfederasi.nama AS konfederasi_nama,
                    federasi.nama AS federasi_nama,
                    spsb.jumlah_anggota AS jumlah_anggota,
                    spsb.keterangan AS keterangan,
                    spsb.kota_id
                FROM 
                    ' . $this->table . ' spsb
                LEFT JOIN 
                    konfederasi ON spsb.konfederasi_id = konfederasi.id
                LEFT JOIN 
                    federasi ON spsb.federasi_id = federasi.id';

        $this->db->query($query);
        return $this->db->resultSet();
    }


    public function getSpsbById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');

        $this->db->bind('id', $id);
        return $this->db->single();
        return $data;
    }

    public function addDataSpsb($data) {
        $query = "INSERT INTO spsb (nama, alamat, no_pencatatan, federasi_id, konfederasi_id, jumlah_anggota, keterangan, kota_id)
                    VALUES
                        (:nama, :alamat, :no_pencatatan, :federasi_id, :konfederasi_id, :jumlah_anggota, :keterangan, :kota_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('federasi_id', empty($data['federasi_id']) ? null : $data['federasi_id']);
        $this->db->bind('konfederasi_id', empty($data['konfederasi_id']) ? null : $data['konfederasi_id']);
        $this->db->bind('jumlah_anggota', empty($data['jumlah_anggota']) ? null : $data['jumlah_anggota']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataSpsb($id) {
        $query = "DELETE FROM spsb WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataSpsb($data) {
        $query = "UPDATE spsb SET
                    nama = :nama,
                    alamat = :alamat,
                    no_pencatatan = :no_pencatatan,
                    federasi_id = :federasi_id,
                    konfederasi_id = :konfederasi_id,
                    jumlah_anggota = :jumlah_anggota,
                    keterangan = :keterangan,
                    kota_id = :kota_id
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('federasi_id', empty($data['federasi_id']) ? null : $data['federasi_id']);
        $this->db->bind('konfederasi_id', empty($data['konfederasi_id']) ? null : $data['konfederasi_id']);
        $this->db->bind('jumlah_anggota', empty($data['jumlah_anggota']) ? null : $data['jumlah_anggota']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}