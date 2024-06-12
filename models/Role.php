<?php
include_once __DIR__ . '/../app/config/conn.php';

class Roles
{
    static function getRoleNameById($roleId)
    {
        global $conn;
        $sql = "SELECT nama_role FROM role WHERE id_role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $roleName = $row['nama_role'];
        $stmt->close();
        return $roleName;
    }
}
