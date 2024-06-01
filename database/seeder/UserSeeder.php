<?php
require_once '../../app/config/conn.php';

class UserSeeder
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function run()
    {
        $users = [
            ['nama' => 'Manager', 'email' => 'manager@example.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'no_telpon' => '123456789', 'id_role' => 1],
            ['nama' => 'Stoker', 'email' => 'stoker@example.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'no_telpon' => '987654321', 'id_role' => 2],
            ['nama' => 'Kasir', 'email' => 'kasir@example.com', 'password' => password_hash('password', PASSWORD_BCRYPT), 'no_telpon' => '456123789', 'id_role' => 3],
        ];

        foreach ($users as $user) {
            $stmt = $this->conn->prepare("INSERT INTO user (nama, email, password, no_telpon, id_role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssi', $user['nama'], $user['email'], $user['password'], $user['no_telpon'], $user['id_role']);
            $stmt->execute();
            $stmt->close();
        }
    }
}
