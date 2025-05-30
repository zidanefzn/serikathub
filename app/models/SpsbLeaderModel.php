<?php

class SpsbLeaderModel {
    private $table = 'pimpinan_spsb';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getSpsbLeaderById($id) {
        $this->db->query('SELECT ps.id AS ps_id, ps.nama AS ps_nama, ps.jabatan AS ps_jabatan, ps.no_telp AS ps_no_telp, s.nama AS spsb_nama FROM ' . $this->table . ' ps
                            JOIN spsb s ON ps.spsb_id = s.id
                            WHERE ps.spsb_id = :id');

        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function addDataSpsbLeader($data) {
        $query = "INSERT INTO pimpinan_spsb (nama, jabatan, no_telp, spsb_id)
                    VALUES
                        (:nama, :jabatan, :no_telp, :spsb_id)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('jabatan', $data['jabatan']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('spsb_id', $data['spsb_id']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteDataSpsbLeader($id) {
        $query = "DELETE FROM pimpinan_spsb WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function editDataSpsbLeader($data) {
        $query = "UPDATE pimpinan_spsb SET
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