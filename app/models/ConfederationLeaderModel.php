<?php

class ConfederationLeaderModel {
    private $table = 'pimpinan_konfederasi';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getConfederationLeaderById($id) {
        $this->db->query('SELECT pk.id AS pk_id, pk.nama AS pk_nama, pk.jabatan AS pk_jabatan, pk.no_telp AS pk_no_telp, k.nama AS konfederasi_nama FROM ' . $this->table . ' pk
                            JOIN konfederasi k ON pk.konfederasi_id = k.id
                            WHERE pk.konfederasi_id = :id');

        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function addDataConfederationLeader($data) {
        $query = "INSERT INTO pimpinan_konfederasi (nama, jabatan, no_telp, konfederasi_id)
                    VALUES
                        (:nama, :jabatan, :no_telp, :konfederasi_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('konfederasi_id', $data['konfederasi_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataConfederationLeader($id) {
        $query = "DELETE FROM pimpinan_konfederasi WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataConfederationLeader($data) {
        $query = "UPDATE pimpinan_konfederasi SET
                    nama = :nama,
                    jabatan = :jabatan,
                    no_telp = :no_telp
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // Di ConfederationLeaderModel, tambahkan method baru:
    public function getLeaderById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}