<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';

class AuthController {
    static function login()
    {
        return view('auth/auth_layout', ['url' => 'login']);
    }

    static function registerAs()
    {
        return view('auth/auth_layout', ['url' => 'choose']);
    }

    static function registerManager()
    {
        return view('auth/auth_layout', ['url' => 'register', 'role' => 'manager']);
    }

    static function registerStoker()
    {
        return view('auth/auth_layout', ['url' => 'register', 'role' => 'stoker']);
    }

    static function registerKasir()
    {
        return view('auth/auth_layout', ['url' => 'register', 'role' => 'kasir']);
    }

    static function registerProses()
    {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password_confirmation' => $_POST['password_confirmation'],
        ];
    }
}