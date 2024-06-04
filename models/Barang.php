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

    public static function getNamaKategori($idKategori)
    {
        global $conn;

        $sql = "SELECT nama_kategori FROM kategori WHERE id_kategori = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idKategori);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['nama_kategori'];
    }

    public static function getBarangWithNamaKategori()
    {
        global $conn;

        $sql = "SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori";
        $result = $conn->query($sql);

        return $result;
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
