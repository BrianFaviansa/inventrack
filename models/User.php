<?php
include_once __DIR__ . '/../app/config/conn.php';

class User
{
    static function login($data = [])
    {
        global $conn;

        $email = $data['email'];
        $password = $data['password'];

        $result = $conn->query("SELECT * FROM user WHERE email = '$email'");
        if ($result = $result->fetch_assoc()) {
            $hashedPassword = $result['password'];
            $verify = password_verify($password, $hashedPassword);
            if ($verify) {
                return $result;
            } else {
                return false;
            }
        }
    }

    public static function register($data = []) {
        global $conn;

        $id_role = $data['id_role'];
        $nama = $data['nama'];
        $password = $data['password'];
        $no_telpon = $data['no_telpon'];
        $email = $data['email'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (id_role, nama, password, no_telpon, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception('Failed to prepare statement: ' . $conn->error);
        }

        $stmt->bind_param('issss', $id_role, $nama, $hashedPassword, $no_telpon, $email);

        if (!$stmt->execute()) {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }

        $result = $stmt->affected_rows > 0;

        $stmt->close();

        return $result;
    }

    public static function countUser()
    {
        global $conn;

        $query = "SELECT COUNT(*) as total FROM user";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $total = $row['total'];

        return $total;
    }
}
