<?php
include_once __DIR__ . '/../app/config/conn.php';

class Barang
{
    public static function getAllBarang()
    {
        global $conn;

        $sql = "SELECT * FROM barang";
        $result = $conn->query($sql);

        return $result;
    }

    public static function countBarang()
    {   
        global $conn;

        $sql = "SELECT COUNT(id_barang) as total FROM barang";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }
}