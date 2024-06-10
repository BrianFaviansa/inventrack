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
            view('stoker/dashboard_layout', ['url' => 'index']);
        }
        else{
            header('location: restricted');
        }
    }
}