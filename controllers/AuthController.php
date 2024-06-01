<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';

class AuthController {
    static function login()
    {
        return view('auth/auth_layout', ['url' => 'login']);
    }
}