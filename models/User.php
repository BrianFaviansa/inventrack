<?php
include_once __DIR__ . '/../app/config/conn.php';

class User
{
    static function getUserByEmail($email)
    {
        global $conn;
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    static function login($email, $password)
    {
        $user = self::getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    static function register($data)
    {
        global $conn;
        $sql = "INSERT INTO user (nama, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $data['name'], $data['email'], $data['password'], $data['role_id']);
        $stmt->execute();
        $stmt->close();
    }
}
