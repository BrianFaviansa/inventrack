<?php
include_once __DIR__ . '/../app/config/conn.php';

class DetailPenjualan
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public static function store($id_penjualan, $id_barang, $kuantitas, $harga)
    {
        global $conn;

        $sql = "INSERT INTO detail_penjualan (id_penjualan, id_barang, jumlah, harga_jual) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiid", $id_penjualan, $id_barang, $kuantitas, $harga); // Tambahkan tipe data untuk parameter $harga
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
