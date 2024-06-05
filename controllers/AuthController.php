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
        $post = array_map('htmlspecialchars', $_POST);
        $requiredFields = ['nama', 'email', 'password', 'id_role'];
        foreach ($requiredFields as $field) {
            if (empty(trim($post[$field]))) {
                http_response_code(400);
                echo json_encode(['message' => 'Harap isi semua kolom yang diperlukan!']);
                exit();
            }
        }

        // Validasi email
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['message' => 'Email tidak valid!']);
            exit();
        }

        try {
            $existingEmail = User::getUserByEmail($post['email']);

            if ($existingEmail) {
                if ($existingEmail['email'] === $post['email']) {
                    throw new Exception('Email telah terdaftar');
                }
            }

            $user = User::register([
                'nama' => $post['nama'],
                'email' => $post['email'],
                'password' => password_hash($post['password'], PASSWORD_DEFAULT),
                'id_role' => $post['id_role']
            ]);

            if ($user) {
                header('Location: login');
            }
            exit();
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => 'Registrasi gagal! Email telah terdaftar!']);
            exit();
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
                header('Location: dashboard-stoker');
            } elseif ($user['id_role'] == '3') {
                $_SESSION['user'] = $user;
                header('Location: dashboard-kasir');
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
