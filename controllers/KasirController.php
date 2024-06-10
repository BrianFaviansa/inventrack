<?php

include_once 'models/User.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class KasirController{
    static function index(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '2'){
            $totalKategori = Kategori::countKategori();
            $totalUser = User::countUser();
            $totalBarang = Barang::countBarang();
            $totalPenjualan = Penjualan::countPenjualan();
            return view('kasir/dashboard_layout', [
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

    static function transaksi()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $barangs = Barang::getBarangOrderByKategori();
            $kategoris = Kategori::getAllKategori();
            return view('kasir/dashboard_layout', [
                'url' => 'transaksi',
                'barangs' => $barangs,
                'kategoris' => $kategoris,
                'user' => $_SESSION['user'],
            ]);
        }
    }

    static function keranjang()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $belanjaans = Cart::getCart(session_id());
            return view('kasir/dashboard_layout', [
                'url' => 'cart',
                'user' => $_SESSION['user'],
                'belanjaans' => $belanjaans,
            ]);
        }
    }
}