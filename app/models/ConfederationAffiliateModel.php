<?php

class ConfederationAffiliateModel {
    private $table = 'federasi';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getConfederationAffiliateById($id) {
    $this->db->query('SELECT f.id AS id,
                        f.nama AS nama,
                        f.alamat AS alamat,
                        f.no_pencatatan AS no_pencatatan,
                        f.keterangan AS keterangan,
                        SUM(spsb.jumlah_anggota) AS total_anggota
                        FROM ' . $this->table . ' f
                        LEFT JOIN spsb ON f.id = spsb.federasi_id
                        JOIN konfederasi k ON f.konfederasi_id = k.id
                        WHERE f.konfederasi_id = :id
                        GROUP BY f.id'
                    );

    $this->db->bind('id', $id);
    return $this->db->resultSet();
}

    public function deleteDataConfederationAffiliate($id) {
        $query = "UPDATE federasi SET konfederasi_id = NULL 
                    WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}