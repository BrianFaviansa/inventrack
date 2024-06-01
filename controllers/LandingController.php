<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';

class LandingController {
    static function index()
    {
        return view('landing/landing_layout', ['url' => 'home']);
    }

    static function about() {
        return view('landing/landing_layout', ['url' => 'about']);
    }
}