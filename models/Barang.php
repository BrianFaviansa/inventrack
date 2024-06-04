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

    public static function store($data) {
        global $conn;

        $sql = "INSERT INTO barang (id_kategori, nama_barang, stok, harga_beli, harga_jual, created_at, gambar) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isiiiss", $data['id_kategori'], $data['nama_barang'], $data['stok'], $data['harga_beli'], $data['harga_jual'], $data['created_at'], $data['gambar']);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public static function destroy($id_barang) {
        global $conn;

        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
