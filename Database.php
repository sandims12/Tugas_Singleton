<?php

class Database {
    private static $instance;
    private $connection;
    
    private function __construct() {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "penjadwalan_acara";
        
        $this->connection = new mysqli($host, $username, $password, $database);
        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

class Acara {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function tambahAcara($nama, $tanggal, $lokasi) {
        $nama = $this->db->real_escape_string($nama);
        $tanggal = $this->db->real_escape_string($tanggal);
        $lokasi = $this->db->real_escape_string($lokasi);
        
        $sql = "INSERT INTO acara (nama_acara, tanggal, lokasi) VALUES ('$nama', '$tanggal', '$lokasi')";
        $result = $this->db->query($sql);
        return $result;
    }
    
    public function lihatAcara() {
        $sql = "SELECT * FROM acara";
        $result = $this->db->query($sql);
        $acara = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $acara[] = $row;
            }
        }
        return $acara;
    }
    
   
}


$acaraObj = new Acara();



// Lihat daftar acara
$daftarAcara = $acaraObj->lihatAcara();

