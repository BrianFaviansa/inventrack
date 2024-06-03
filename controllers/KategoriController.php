<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/Kategori.php';

class KategoriController{
    public static function store() {
        $nama = $_POST['nama'];

        if (empty($nama)) {
            setFlashMessage('error', 'Nama kategori tidak boleh kosong');
            return header('location: dashboard-manager/kategori');
        }

        Kategori::store($nama);
    
        setFlashMessage('success', 'Kategori berhasil ditambahkan');
        return header('location: dashboard-manager/kategori');
    }
}