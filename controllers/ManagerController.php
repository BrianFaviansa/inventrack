<?php

include_once 'models/User.php';
include_once 'function/main.php';
include_once 'app/config/static.php';

class ManagerController{
    static function index(){
        $user = $_SESSION['user'];
        $user_role = $user['id_role'];
        if ($user_role == '1'){
            view('manager/dashboard_layout', ['url' => 'manager_tes']);
        }
        else{
            header('location: restricted');
        }
    }
}