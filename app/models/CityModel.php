<?php

class cityModel {
   private $table = 'kota';
   private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCity() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }
}