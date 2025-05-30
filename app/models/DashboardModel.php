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
        $query = "
            SELECT 
                p.id AS provinsi_id,
                p.nama AS provinsi_nama,
                COALESCE(spsb_summary.jumlah_spsb, 0) AS jumlah_spsb,
                COALESCE(spsb_summary.total_anggota, 0) AS total_anggota,
                COALESCE(federasi_summary.jumlah_federasi, 0) AS jumlah_federasi,
                COALESCE(konfederasi_summary.jumlah_konfederasi, 0) AS jumlah_konfederasi
            FROM provinsi p
            LEFT JOIN (
                SELECT 
                    k.provinsi_id,
                    COUNT(s.id) AS jumlah_spsb,
                    SUM(s.jumlah_anggota) AS total_anggota
                FROM spsb s
                JOIN kota k ON s.kota_id = k.id
                GROUP BY k.provinsi_id
            ) AS spsb_summary ON spsb_summary.provinsi_id = p.id
            LEFT JOIN (
                SELECT 
                    k.provinsi_id,
                    COUNT(f.id) AS jumlah_federasi
                FROM federasi f
                JOIN kota k ON f.kota_id = k.id
                GROUP BY k.provinsi_id
            ) AS federasi_summary ON federasi_summary.provinsi_id = p.id
            LEFT JOIN (
                SELECT 
                    k.provinsi_id,
                    COUNT(konf.id) AS jumlah_konfederasi
                FROM konfederasi konf
                JOIN kota k ON konf.kota_id = k.id
                GROUP BY k.provinsi_id
            ) AS konfederasi_summary ON konfederasi_summary.provinsi_id = p.id
            ORDER BY p.nama
        ";
        $this->db->query($query);
        return $this->db->resultSet();
    }



}