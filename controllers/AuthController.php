<?php 

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Role.php';

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
        $role_id = 1;
        $nama_role = Roles::getRoleNameById($role_id);

        return view('auth/auth_layout', ['url' => 'register', 'role_id' => $role_id, 'nama_role' => $nama_role]);
    }

    static function registerStoker()
    {
        $role_id = 2;
        $nama_role = Roles::getRoleNameById($role_id);


        return view('auth/auth_layout', ['url' => 'register', 'role_id' => $role_id, 'nama_role' => $nama_role]);
    }

    static function registerKasir()
    {
        $role_id = 3;
        $nama_role = Roles::getRoleNameById($role_id);


        return view('auth/auth_layout', ['url' => 'register', 'role_id' => $role_id, 'nama_role' => $nama_role]);
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

    static function loginProses()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::login($email, $password);

        if (!$user) {
            setFlashMessage('error', 'Email atau Password Salah!');
            header('Location: login');
            return;
        }

        $auth = [
            'id_user' => $user['id_user'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'id_role' => $user['id_role'],
        ];
        
        setFlashMessage('success', 'Login Berhasil, Selamat Datang!' );
        return view('beranda/beranda_layout', ['url' => 'beranda', 'auth' => $auth]);
    }

    static function logout()
    {
        session_destroy();
        header('Location: login');
    }
}