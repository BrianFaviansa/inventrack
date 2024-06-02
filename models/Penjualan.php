<?php
include_once __DIR__ . '/../app/config/conn.php';

class Penjualan
{
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
}
