<?php
include_once __DIR__ . '/../app/config/conn.php';

class Penjualan
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public static function getAllPenjualan()
    {
        global $conn;

        $sql = "SELECT * FROM penjualan";
        $result = $conn->query($sql);

        return $result;
    }

    public static function countPenjualan()
    {   
        global $conn;

        $sql = "SELECT COUNT(id_penjualan) as total FROM penjualan";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }

    public static function store($id_user, $total_harga, $tanggal_penjualan)
    {
        global $conn;

        $sql = "INSERT INTO penjualan (id_user, total_harga, tanggal_penjualan) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ids", $id_user, $total_harga, $tanggal_penjualan);
        $stmt->execute();

        return $stmt->insert_id;
    }
}
