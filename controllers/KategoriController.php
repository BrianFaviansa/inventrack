<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/Kategori.php';

class KategoriController{
    public static function create() {
        $nama = $_POST['nama'];

        if (empty($nama)) {
            setFlashMessage('error', 'Nama kategori tidak boleh kosong');
            return header('location: dashboard-manager/kategori');
        }

        Kategori::store($nama);
    
        setFlashMessage('success', 'Kategori berhasil ditambahkan');
        return header('location: dashboard-manager/kategori');
    }

    public static function edit() {
        $id_kategori = $_POST['id_kategori'];
        $nama = $_POST['nama_kategori'];

        if (empty($nama)) {
            setFlashMessage('error', 'Nama kategori tidak boleh kosong');
            return header('location: dashboard-manager/kategori');
        }

        Kategori::update($id_kategori, $nama);
    
        setFlashMessage('success', 'Kategori berhasil diubah');
        return header('location: dashboard-manager/kategori');
    }

    public static function delete() {
        $id_kategori = $_POST['id_kategori'];

        Kategori::destroy($id_kategori);

        setFlashMessage('success', 'Kategori berhasil dihapus');
        return header('location: dashboard-manager/kategori');
    }
}