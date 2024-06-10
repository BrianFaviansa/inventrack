<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Kategori.php';
include_once 'models/Barang.php';
include_once 'models/Penjualan.php';
include_once 'models/Cart.php';

class StokerController {
    static function index(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '3'){
            $totalKategori = Kategori::countKategori();
            $totalUser = User::countUser();
            $totalBarang = Barang::countBarang();
            $totalPenjualan = Penjualan::countPenjualan();
            return view('stoker/dashboard_layout', [
                'url' => 'stats',
                'user' => $_SESSION['user'],
                'totalKategori' => $totalKategori,
                'totalUser' => $totalUser,
                'totalBarang' => $totalBarang,
                'totalPenjualan' => $totalPenjualan,
            ]);
        }
        else{
            header('location: restricted');
        }
    }

    static function kategori()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $kategoris = Kategori::getAllKategori();
            return view('stoker/dashboard_layout', [
                'url' => 'kategori',
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
            return view('stoker/dashboard_layout', [
                'url' => 'barang',
                'barangs' => $barangs,
                'kategoris' => $kategoris,
                'user' => $_SESSION['user'],
            ]);
        }
    }
}