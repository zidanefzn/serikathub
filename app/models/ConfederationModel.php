<?php

class ConfederationModel {
   private $table = 'konfederasi';
   private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllConfederation() {
        $this->db->query('SELECT konfederasi.id, konfederasi.nama, konfederasi.alamat, 
                            konfederasi.no_pencatatan, konfederasi.keterangan, 
                            SUM(spsb.jumlah_anggota) AS total_anggota FROM ' . $this->table . ' AS 
                            konfederasi LEFT JOIN spsb ON konfederasi.id = spsb.konfederasi_id GROUP BY konfederasi.id');
        return $this->db->resultSet();
    }

    public function getConfederationById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');

        $this->db->bind('id', $id);
        return $this->db->single();
        return $data;
    }

    public function addDataConfederation($data) {
        $query = "INSERT INTO konfederasi (nama, alamat, no_pencatatan, keterangan, kota_id)
                    VALUES
                        (:nama, :alamat, :no_pencatatan, :keterangan, :kota_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataConfederation($id) {
        $query = "DELETE FROM konfederasi WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();
        
        return $this->db->rowCount();
    }

    public function editDataConfederation($data) {
        $query = "UPDATE konfederasi SET
                    nama = :nama,
                    alamat = :alamat,
                    no_pencatatan = :no_pencatatan,
                    keterangan = :keterangan,
                    kota_id = :kota_id
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}