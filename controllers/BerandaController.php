<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';

class BerandaController {
    static function index()
    {
        return view('beranda/beranda_layout', ['url' => 'beranda']);
    }
}