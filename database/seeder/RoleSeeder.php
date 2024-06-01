<?php
require_once '../../app/config/conn.php';

class RoleSeeder
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function run()
    {
        $roles = ['Manager', 'Stoker', 'Kasir'];

        foreach ($roles as $role) {
            $stmt = $this->conn->prepare("INSERT INTO role (nama_role) VALUES (?)");
            $stmt->bind_param('s', $role);
            $stmt->execute();
            $stmt->close();
        }
    }
}
