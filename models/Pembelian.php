<?php
include_once __DIR__ . '/../app/config/conn.php';

class Pembelian
{
    public static function getAllPembelian()
    {
        global $conn;

        $sql = "SELECT * FROM pembelian";
        $result = $conn->query($sql);

        return $result;
    }

    public static function countPembelian()
    {   
        global $conn;

        $sql = "SELECT COUNT(id_pembelian) as total FROM pembelian";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }
}