<?php
require_once '../../app/config/conn.php';

class KategoriSeeder
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function run()
    {
        $kategoris = ['Elektronik', 'Peralatan Tulis dan Kantor', 'Pakaian dan Tekstil', 'Makanan dan Minuman', 'Peralatan Rumah Tangga', 'Kesehatan dan Kecantikan', 'Peralatan Pertanian dan Kebun', 'Peralatan Keamanan', 'Mainan', 'Lainnya'];

        foreach ($kategoris as $kategori) {
            $stmt = $this->conn->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
            $stmt->bind_param('s', $kategori);
            $stmt->execute();
            $stmt->close();
        }
    }
}
