<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';

class DashboardController {
    static function index()
    {
        return view('dashboard/dashboard_layout', ['url' => 'barang']);
    }

    static function manager()
    {
        return view('dashboard/dashboard_layout', ['url' => 'manager_tes']);
    }
}