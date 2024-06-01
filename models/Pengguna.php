<?php
include_once __DIR__ . '/../app/config/conn.php';

class Pengguna
{
    static function getUserByEmail($email)
    {
        global $conn;
        $sql = "SELECT * FROM pengguna WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row;
    }

    static function register($data)
    {
        global $conn;
        $sql = "INSERT INTO pengguna (nama, email, password, role_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $data['name'], $data['email'], $data['password'], $data['role_id']);
        $stmt->execute();
        $stmt->close();
    }
}
