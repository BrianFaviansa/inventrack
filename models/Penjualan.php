<?php
include_once __DIR__ . '/../app/config/conn.php';

class Penjualan
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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

    public static function store($id_user, $total_harga, $tanggal_penjualan)
    {
        global $conn;

        $sql = "INSERT INTO penjualan (id_user, total_harga, tanggal_penjualan) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ids", $id_user, $total_harga, $tanggal_penjualan);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public static function getAllPenjualanByTanggal() {
        global $conn;

        $sql = "SELECT tanggal_penjualan, SUM(total_harga) AS total_penjualan FROM penjualan GROUP BY tanggal_penjualan order by tanggal_penjualan asc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }
}
