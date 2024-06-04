<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/Barang.php';


class BarangController
{
    public static function create()
    {
        $data = [
            'id_kategori' => $_POST['id_kategori'],
            'nama_barang' => $_POST['nama_barang'],
            'stok' => $_POST['stok'],
            'harga_beli' => $_POST['harga_beli'],
            'harga_jual' => $_POST['harga_jual'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambarName = $_FILES['gambar']['name'];
            $gambarTmpName = $_FILES['gambar']['tmp_name'];
            $gambarSize = $_FILES['gambar']['size'];
            $gambarType = $_FILES['gambar']['type'];

            // Check if the uploaded file is an image
            $allowedTypes = ['image/jpeg', 'image/png'];
            if (!in_array($gambarType, $allowedTypes)) {
                setFlashMessage('error', 'File yang diupload harus berupa gambar');
                return;
            }

            // Define the directory to save the uploaded image
            $uploadDir = __DIR__ . '/../assets/storage/barang_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generate a new unique file name with current timestamp
            $timestamp = time();
            $fileExtension = pathinfo($gambarName, PATHINFO_EXTENSION);
            $newFileName = basename($gambarName, ".$fileExtension") . "_" . $timestamp . ".$fileExtension";
            $gambarPath = $uploadDir . $newFileName;

            // Move the uploaded image to the specified directory
            if (move_uploaded_file($gambarTmpName, $gambarPath)) {
                $data['gambar'] = $newFileName; // Store only the file name in the database
            } else {
                echo 'Gagal mengupload gambar';
                return;
            }
        } else {
            echo 'Terjadi kesalahan saat mengupload gambar';
            return;
        }

        $store = Barang::store($data);

        if ($store) {
            header('location: dashboard-manager/barang');
        } else {
            echo 'Gagal menambahkan barang';
        }
    }
}
