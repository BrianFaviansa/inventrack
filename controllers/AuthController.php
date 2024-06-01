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

    static function sessionLogin(){
        $post = array_map('htmlspecialchars', $_POST);
    
        $user = User::login([
            'email' => $post['email'], 
            'password' => $post['password']
        ]);
        if ($user) {
            unset($user['password']);
            if($user['id_role'] == '1'){
                $_SESSION['user'] = $user;
                header('Location: dashboard-manager');
            }
            elseif($user['id_role'] == '2'){
                $_SESSION['user'] = $user;
                header('Location: dashboard-stoker');
            }
            elseif($user['id_role'] == '3'){
                $_SESSION['user'] = $user;
                header('Location: dashboard-kasir');
            }
        }
        else {
            header('Location: '.BASEURL.'login?failed=true');
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