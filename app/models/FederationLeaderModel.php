<?php

class FederationLeaderModel {
    private $table = 'pimpinan_federasi';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getFederationLeaderById($id) {
        $this->db->query('SELECT pf.id AS pf_id, pf.nama AS pf_nama, pf.jabatan AS pf_jabatan, pf.no_telp AS pf_no_telp, f.nama AS federasi_nama FROM ' . $this->table . ' pf
                            JOIN federasi f ON pf.federasi_id = f.id
                            WHERE pf.federasi_id = :id');

        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function addDataFederationLeader($data) {
        $query = "INSERT INTO pimpinan_federasi (nama, jabatan, no_telp, federasi_id)
                    VALUES
                        (:nama, :jabatan, :no_telp, :federasi_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('federasi_id', $data['federasi_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataFederationLeader($id) {
        $query = "DELETE FROM pimpinan_federasi WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataFederationLeader($data) {
        $query = "UPDATE pimpinan_federasi SET
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

    public function getLeaderById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}