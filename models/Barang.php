<?php
include_once __DIR__ . '/../app/config/conn.php';

class Barang
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

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

    public function kategori($id_barang)
    {
        $sql = "SELECT k.* FROM kategori k JOIN barang b ON b.id_kategori = k.id_kategori WHERE b.id_barang = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function detailPembelian($id_barang)
    {
        $sql = "SELECT * FROM detail_pembelian WHERE id_barang = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function detailPenjualan($id_barang)
    {
        $sql = "SELECT * FROM detail_penjualan WHERE id_barang = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}