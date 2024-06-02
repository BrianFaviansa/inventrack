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

    static function register($data = [])
    {
        global $conn;

        $nama = $data['nama'];
        $password = $data['password'];
        $email = $data['email'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user SET nama = ?, password = ?, email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $nama, $hashedPassword, $email);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    static function getPassword($nama)
    {
        global $conn;
        $sql = "SELECT password FROM user WHERE nama = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $nama);
        $stmt->execute();

        $result = $stmt->affected_rows > 0 ? true : false;
        return $result;
    }

    public static function getUserByEmail($email)
    {
        global $conn;

        $email = $conn->real_escape_string($email);

        $query = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public static function getUserById($id)
    {
        global $conn;

        $id = $conn->real_escape_string($id);

        $query = "SELECT * FROM users WHERE id = '$id' LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
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
