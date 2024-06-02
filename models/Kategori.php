<?php
include_once __DIR__ . '/../app/config/conn.php';

class Kategori
{
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
}
