<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Kategori.php';
include_once 'models/Barang.php';
include_once 'models/Penjualan.php';

class ManagerController
{
    static function index()
    {
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '1') {
            $totalKategori = Kategori::countKategori();
            $totalUser = User::countUser();
            $totalBarang = Barang::countBarang();
            $totalPenjualan = Penjualan::countPenjualan();
            return view('manager/dashboard_layout', [
                'url' => 'stats',
                'user' => $user,
                'totalKategori' => $totalKategori,
                'totalUser' => $totalUser,
                'totalBarang' => $totalBarang,
                'totalPenjualan' => $totalPenjualan,
            ]);
        } else {
            header('location: restricted');
        }
    }

    static function kategori()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
                'url' => 'kategori/kategori',
                'kategoris' => $kategoris,
                'user' => $_SESSION['user'],
            ]);
        }
    }

    static function barang()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $barangs = Barang::getBarangWithNamaKategori();
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
                'url' => 'barang/barang',
                'barangs' => $barangs,
                'kategoris' => $kategoris,
                'user' => $_SESSION['user'],
            ]);
        }
    }

    static function transaksi()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $barangs = Barang::getBarangWithNamaKategori();
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
                'url' => 'transaksi/transaksi',
                'barangs' => $barangs,
                'kategoris' => $kategoris,
                'user' => $_SESSION['user'],
            ]);
        }
    }
}
