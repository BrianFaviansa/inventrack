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

    public static function getBarangOrderByKategori()
    {
        global $conn;

        $sql = "SELECT * FROM barang ORDER BY id_kategori";
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

    public static function getBarangWithNamaKategori()
    {
        global $conn;

        $sql = "SELECT barang.*, kategori.nama_kategori FROM barang JOIN kategori ON barang.id_kategori = kategori.id_kategori order by kategori.nama_kategori";
        $result = $conn->query($sql);

        return $result;
    }
    public static function store($data)
    {
        global $conn;

        $sql = "INSERT INTO barang (id_kategori, nama_barang, harga_beli, harga_jual, created_at, gambar) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isisss", $data['id_kategori'], $data['nama_barang'], $data['harga_beli'], $data['harga_jual'], $data['created_at'], $data['gambar']);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public static function update($id_barang, $data)
    {
        global $conn;

        $sql = "UPDATE barang SET id_kategori = ?, nama_barang = ?, gambar = ?, harga_beli = ?, harga_jual = ? WHERE id_barang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issiii", $data['id_kategori'], $data['nama_barang'], $data['gambar'], $data['harga_beli'], $data['harga_jual'], $id_barang);
        $stmt->execute();

        return $stmt->affected_rows;
    }



    public static function destroy($id_barang)
    {
        global $conn;

        $sql = "DELETE FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public static function getImageName($id_barang)
    {
        global $conn;

        $sql = "SELECT gambar FROM barang WHERE id_barang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['gambar'];
    }
}
