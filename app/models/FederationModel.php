<?php

class FederationModel {
   private $table = 'federasi';
   private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllFederation() {
        $this->db->query('SELECT federasi.id, federasi.nama, federasi.alamat, 
                            federasi.no_pencatatan, federasi.keterangan, 
                            SUM(spsb.jumlah_anggota) AS total_anggota FROM ' . $this->table . ' AS 
                            federasi LEFT JOIN spsb ON federasi.id = spsb.federasi_id GROUP BY federasi.id');
        return $this->db->resultSet();
    }

    public function getFederationById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');

        $this->db->bind('id', $id);
        return $this->db->single();
        return $data;
    }

    public function addDataFederation($data) {
        $query = "INSERT INTO federasi (nama, alamat, no_pencatatan, konfederasi_id, keterangan, kota_id)
                    VALUES
                        (:nama, :alamat, :no_pencatatan, :konfederasi_id, :keterangan, :kota_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('konfederasi_id', empty($data['konfederasi_id']) ? null : $data['konfederasi_id']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataFederation($id) {
        try {
            $query = "DELETE FROM federasi WHERE id = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        } catch (PDOException $e) {
            if ($e->getCode() == '23000' && strpos($e->getMessage(), '1451') !== false) {
                return -1;
            }
            throw $e;
        }
    }

    public function editDataFederation($data) {
        $query = "UPDATE federasi SET
                    nama = :nama,
                    alamat = :alamat,
                    no_pencatatan = :no_pencatatan,
                    konfederasi_id = :konfederasi_id,
                    keterangan = :keterangan,
                    kota_id = :kota_id
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_pencatatan', $data['no_pencatatan']);
        $this->db->bind('konfederasi_id', empty($data['konfederasi_id']) ? null : $data['konfederasi_id']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('kota_id', $data['kota_id']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}