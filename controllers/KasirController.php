<?php

include_once 'models/User.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class KasirController{
    static function index(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '3'){
            view('kasir/dashboard_layout', ['url' => 'index']);
        }
        else{
            header('location: restricted');
        }
    }
}