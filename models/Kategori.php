<?php
include_once __DIR__ . '/../app/config/conn.php';

class Kategori
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public static function getAllKategori()
    {
        global $conn;

        $sql = "SELECT * FROM kategori";
        $result = $conn->query($sql);

        return $result;
    }

    public static function countKategori()
    {   
        global $conn;

        $sql = "SELECT COUNT(id_kategori) as total FROM kategori";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }

    public function barang($id_kategori)
    {
        $sql = "SELECT * FROM barang WHERE id_kategori = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function store($nama)
    {
        global $conn;
        
        $sql = "INSERT INTO kategori (nama_kategori) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nama);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
