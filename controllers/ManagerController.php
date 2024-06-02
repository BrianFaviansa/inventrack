<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Kategori.php';
include_once 'models/Barang.php';
include_once 'models/Penjualan.php';
include_once 'models/Pembelian.php';

class ManagerController{
    static function index(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '1'){
            $totalKategori = Kategori::countKategori();
            $totalUser = User::countUser();
            $totalBarang = Barang::countBarang();
            $totalPenjualan = Penjualan::countPenjualan();
            $totalPembelian = Pembelian::countPembelian();

            return view('manager/dashboard_layout', [
                'url' => 'stats',
                'totalKategori' => $totalKategori,
                'totalUser' => $totalUser,
                'totalBarang' => $totalBarang,
                'totalPenjualan' => $totalPenjualan,
                'totalPembelian' => $totalPembelian,
            ]);
        }
        else{
            header('location: restricted');
        }
    }

    static function kategori(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '1'){
            $kategoris = Kategori::getAllKategori();
            return view('manager/dashboard_layout', [
                'url' => 'kategori',
                'kategoris' => $kategoris,
            ]);
        }
        else{
            header('location: restricted');
        }
    }
}