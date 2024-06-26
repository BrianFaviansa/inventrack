<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Role.php';

class AuthController
{
    static function index()
    {
        return view('beranda/beranda_layout', ['url' => 'beranda']);
    }
    static function login()
    {
        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['id_role'] == '1') {
                header('Location: dashboard-manager');
            } elseif ($_SESSION['user']['id_role'] == '2') {
                header('Location: dashboard-kasir');
            } elseif ($_SESSION['user']['id_role'] == '3') {
                header('Location: dashboard-stoker');
            }
        } else {
            return view('auth/auth_layout', ['url' => 'login']);
        }
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

    static function registerKasir()
    {
        $role_id = 2;
        $nama_role = Roles::getRoleNameById($role_id);


        return view('auth/auth_layout', ['url' => 'register', 'role_id' => $role_id, 'nama_role' => $nama_role]);
    }

    static function registerStoker()
    {
        $role_id = 3;
        $nama_role = Roles::getRoleNameById($role_id);


        return view('auth/auth_layout', ['url' => 'register', 'role_id' => $role_id, 'nama_role' => $nama_role]);
    }

    static function registerProses()
    {
        $post = array_map('htmlspecialchars', $_POST);
        $errors = [];

        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email tidak valid';
        }

        if (strlen($post['nama']) < 3) {
            $errors[] = 'Nama minimal 3 huruf';
        }

        if (strlen($post['password']) < 5) {
            $errors[] = 'Password minimal 5 huruf';
        }

        if (!empty($errors)) {
            $errorMessage = implode(', ', $errors);
            setFlashMessage('error', $errorMessage);
            if ($post['id_role'] == 1) {
                header('Location: register/manager');
                return;
            } elseif ($post['id_role'] == 2) {
                header('Location: register/kasir');
                return;
            } elseif ($post['id_role'] == 3) {
                header('Location: register/stoker');
                return;
            }
        }

        $user = User::register([
            'nama' => $post['nama'],
            'email' => $post['email'],
            'password' => $post['password'],
            'no_telpon' => $post['no_telpon'],
            'id_role' => $post['id_role']
        ]);

        if ($user) {
            setFlashMessage('success', 'Berhasil mendaftar');
            header('Location: login');
        } else {
            setFlashMessage('success', 'Gagal mendaftar');
            if ($post['id_role'] == 1) {
                header('Location: register/manager');
                return;
            } elseif ($post['id_role'] == 2) {
                header('Location: register/kasir');
                return;
            } elseif ($post['id_role'] == 3) {
                header('Location: register/stoker');
                return;
            }
        }
    }
    static function sessionLogin()
    {
        $post = array_map('htmlspecialchars', $_POST);

        $user = User::login([
            'email' => $post['email'],
            'password' => $post['password']
        ]);
        if ($user) {
            unset($user['password']);
            if ($user['id_role'] == '1') {
                $_SESSION['user'] = $user;
                header('Location: dashboard-manager');
            } elseif ($user['id_role'] == '2') {
                $_SESSION['user'] = $user;
                header('Location: dashboard-kasir');
            } elseif ($user['id_role'] == '3') {
                $_SESSION['user'] = $user;
                header('Location: dashboard-stoker');
            }
        } else {
            setFlashMessage('error', 'Email atau password salah');
            header('Location: login');
        }
    }

    static function logout()
    {
        session_destroy();
        header('Location: login');
    }

    static function restricted()
    {
        return view('auth/auth_layout', ['url' => 'restricted']);
    }
}
