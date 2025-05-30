<?php

class ProvinceModel {
   private $table = 'provinsi';
   private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllProvince() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}