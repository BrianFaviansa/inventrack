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
            'harga_beli' => $_POST['harga_beli'],
            'harga_jual' => $_POST['harga_jual'],
            'created_at' => date('Y-m-d H:i:s'),
        ];

        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambarName = $_FILES['gambar']['name'];
            $gambarTmpName = $_FILES['gambar']['tmp_name'];
            $gambarSize = $_FILES['gambar']['size'];
            $gambarType = $_FILES['gambar']['type'];

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($gambarType, $allowedTypes)) {
                setFlashMessage('error', 'File yang diupload harus berupa gambar');
                if ($_SESSION['user']['id_role'] == 1) {
                    header('location: dashboard-manager/barang');
                } else if ($_SESSION['user']['id_role'] == 3) {
                    header('location: dashboard-stoker/barang');
                }
                return;
            }

            $uploadDir = __DIR__ . '/../assets/storage/barang_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $timestamp = time();
            $fileExtension = pathinfo($gambarName, PATHINFO_EXTENSION);
            $newFileName = basename($gambarName, ".$fileExtension") . "_" . $timestamp . ".$fileExtension";
            $gambarPath = $uploadDir . $newFileName;

            if (move_uploaded_file($gambarTmpName, $gambarPath)) {
                $data['gambar'] = $newFileName;
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
            setFlashMessage('success', 'Barang berhasil ditambahkan');
            if ($_SESSION['user']['id_role'] == 1) {
                header('location: dashboard-manager/barang');
            } else if ($_SESSION['user']['id_role'] == 3) {
                header('location: dashboard-stoker/barang');
            }
        } else {
            echo 'Gagal menambahkan barang';
        }
    }

    public static function edit()
    {
        $id_barang = $_POST['id_barang'];
        $data = [
            'id_kategori' => $_POST['id_kategori'],
            'nama_barang' => $_POST['nama_barang'],
            'harga_beli' => $_POST['harga_beli'],
            'harga_jual' => $_POST['harga_jual'],
        ];

        $currentImageName = Barang::getImageName($id_barang);

        if ($_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambarName = $_FILES['gambar']['name'];
            $gambarTmpName = $_FILES['gambar']['tmp_name'];
            $gambarSize = $_FILES['gambar']['size'];
            $gambarType = $_FILES['gambar']['type'];

            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($gambarType, $allowedTypes)) {
                setFlashMessage('error', 'File yang diupload harus berupa gambar');
                if ($_SESSION['user']['id_role'] == 1) {
                    header('location: dashboard-manager/barang');
                } else if ($_SESSION['user']['id_role'] == 3) {
                    header('location: dashboard-stoker/barang');
                }
                return;
            }

            $uploadDir = __DIR__ . '/../assets/storage/barang_images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $timestamp = time();
            $fileExtension = pathinfo($gambarName, PATHINFO_EXTENSION);
            $newFileName = basename($gambarName, ".$fileExtension") . "_" . $timestamp . ".$fileExtension";
            $gambarPath = $uploadDir . $newFileName;

            if (!empty($currentImageName)) {
                $oldImagePath = $uploadDir . $currentImageName;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            if (move_uploaded_file($gambarTmpName, $gambarPath)) {
                $data['gambar'] = $newFileName;
            } else {
                echo 'Gagal mengupload gambar';
                return;
            }
        } else {
            $data['gambar'] = $currentImageName;
        }

        $update = Barang::update($id_barang, $data);

        if ($update) {
            setFlashMessage('success', 'Data barang berhasil diperbarui');
            if ($_SESSION['user']['id_role'] == 1) {
                header('location: dashboard-manager/barang');
            } else if ($_SESSION['user']['id_role'] == 3) {
                header('location: dashboard-stoker/barang');
            }
        } else {
            echo 'Gagal memperbarui data barang';
        }
    }

    public static function delete()
    {
        $id_barang = $_POST['id_barang'];
        $delete = Barang::destroy($id_barang);

        if ($delete) {
            setFlashMessage('success', 'Barang berhasil dihapus');
            if ($_SESSION['user']['id_role'] == 1) {
                header('location: dashboard-manager/barang');
            } else if ($_SESSION['user']['id_role'] == 3) {
                header('location: dashboard-stoker/barang');
            }
        } else {
            echo 'Gagal menghapus barang';
        }
    }
}
