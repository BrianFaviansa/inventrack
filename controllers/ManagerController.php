<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Kategori.php';
include_once 'models/Barang.php';
include_once 'models/Penjualan.php';
include_once 'models/Cart.php';

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
            $barangs = Barang::getAllBarang();
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
                'url' => 'stats',
                'user' => $user,
                'totalKategori' => $totalKategori,
                'totalUser' => $totalUser,
                'totalBarang' => $totalBarang,
                'totalPenjualan' => $totalPenjualan,
                'barangs' => $barangs,
                'kategoris' => $kategoris,
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
            return view('manager/dashboard_layout', [
                'url' => 'barang',
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
            $barangs = Barang::getBarangOrderByKategori();
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
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
            return view('manager/dashboard_layout', [
                'url' => 'cart',
                'user' => $_SESSION['user'],
                'belanjaans' => $belanjaans,
            ]);
        }
    }

    static function statistik()
    {
        if (!isset($_SESSION['user'])) {
            header('location: login');
        } else {
            $statistiks = Penjualan::getAllPenjualanByTanggal();
            return view('manager/dashboard_layout', [
                'url' => 'statistik',
                'statistiks' => $statistiks,
                'user' => $_SESSION['user'],
            ]);
        }
    }
}
