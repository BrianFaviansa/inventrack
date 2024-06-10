<?php
include_once __DIR__ . '/../app/config/conn.php';

class Cart {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public static function store($id_barang)
    {
        global $conn;

        $sql = "INSERT INTO cart (id_barang) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}