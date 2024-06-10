<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/Kategori.php';

class KategoriController
{
    public static function create()
    {
        $data = [
            'nama' => $_POST['nama'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (empty($data['nama'])) {
            setFlashMessage('error', 'Nama kategori tidak boleh kosong');
            if ($_SESSION['user']['id_role'] == 1) {
                return header('location: dashboard-manager/kategori');
            } else {
                return header('location: dashboard-stoker/kategori');
            }
        }

        Kategori::store($data);

        setFlashMessage('success', 'Kategori berhasil ditambahkan');
        if ($_SESSION['user']['id_role'] == 1) {
            return header('location: dashboard-manager/kategori');
        } else {
            return header('location: dashboard-stoker/kategori');
        }
    }

    public static function edit()
    {
        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama_kategori'];

        if (empty($nama)) {
            setFlashMessage('error', 'Nama kategori tidak boleh kosong');
            if ($_SESSION['user']['id_role'] == 1) {
                return header('location: dashboard-manager/kategori');
            } else {
                return header('location: dashboard-stoker/kategori');
            }
        }

        Kategori::update($id_kategori, $nama);

        setFlashMessage('success', 'Kategori berhasil diubah');
        if ($_SESSION['user']['id_role'] == 1) {
            return header('location: dashboard-manager/kategori');
        } else {
            return header('location: dashboard-stoker/kategori');
        }
    }

    public static function delete()
    {
        $id_kategori = $_POST['id_kategori'];

        Kategori::destroy($id_kategori);

        setFlashMessage('success', 'Kategori berhasil dihapus');
        if ($_SESSION['user']['id_role'] == 1) {
            return header('location: dashboard-manager/kategori');
        } else {
            return header('location: dashboard-stoker/kategori');
        }
    }
}
