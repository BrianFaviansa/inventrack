<?php
include_once __DIR__ . '/../app/config/db_connect.php';

class Roles
{
    static function getRoleNameById($roleId)
    {
        global $conn;
        $sql = "SELECT nama_role FROM role WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $roleId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $roleName = $row['name'];
        $stmt->close();
        return $roleName;
    }

    static function getRoleIdByName($roleName)
    {
        global $conn;
        $sql = "SELECT id FROM role WHERE nama_role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $roleName);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $roleId = $row['id'];
        $stmt->close();
        return $roleId;
    }
}
