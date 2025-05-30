<?php

class DashboardModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getTotalConfederation() {
        $this->db->query('SELECT COUNT(*) AS total_konfederasi FROM konfederasi');
        return $this->db->single();
    }

    public function getTotalFederation() {
        $this->db->query('SELECT COUNT(*) AS total_federasi FROM federasi');
        return $this->db->single();
    }
    public function getTotalSpsb() {
        $this->db->query('SELECT COUNT(*) AS total_spsb FROM spsb');
        return $this->db->single();
    }

    public function getSpsbSummaryByProvince() {
    $query = "SELECT 
                p.id AS provinsi_id,
                p.nama AS provinsi_nama,
                COUNT(s.id) AS jumlah_spsb,
                COALESCE(SUM(s.jumlah_anggota), 0) AS total_anggota
              FROM provinsi p
              LEFT JOIN kota k ON k.provinsi_id = p.id
              LEFT JOIN spsb s ON s.kota_id = k.id
              GROUP BY p.id, p.nama
              ORDER BY p.nama";
    $this->db->query($query);
    return $this->db->resultSet();
}

}