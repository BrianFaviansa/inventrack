<?php
include_once __DIR__ . '/../app/config/conn.php';

class Cart
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public static function store($id_barang, $session_id)
    {
        global $conn;

        // Check if the item already exists in the cart
        $sql_check = "SELECT kuantitas FROM keranjang WHERE id_barang = ? AND session_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("is", $id_barang, $session_id);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            // Item exists, update the kuantitas
            $row = $result_check->fetch_assoc();
            $new_kuantitas = $row['kuantitas'] + 1;

            $sql_update = "UPDATE keranjang SET kuantitas = ? WHERE id_barang = ? AND session_id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("iis", $new_kuantitas, $id_barang, $session_id);
            $stmt_update->execute();

            return $stmt_update->affected_rows;
        } else {
            // Item does not exist, insert new entry
            $sql_insert = "INSERT INTO keranjang (id_barang, session_id, kuantitas) VALUES (?, ?, 1)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bind_param("is", $id_barang, $session_id);
            $stmt_insert->execute();

            return $stmt_insert->affected_rows;
        }
    }

    public static function getCart($session_id)
    {
        global $conn;

        $sql = "SELECT barang.id_barang, barang.nama_barang, barang.harga_jual, barang.gambar, keranjang.kuantitas FROM keranjang JOIN barang ON keranjang.id_barang = barang.id_barang WHERE keranjang.session_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function updateQuantity($id_barang, $session_id, $kuantitas)
    {
        global $conn;

        $sql = "UPDATE keranjang SET kuantitas = ? WHERE id_barang = ? AND session_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $kuantitas, $id_barang, $session_id);
        $stmt->execute();

        $affected_rows = $stmt->affected_rows;
        return $affected_rows;
    }

    public static function deleteItem($id_barang)
    {
        global $conn;

        $sql = "DELETE FROM keranjang WHERE id_barang = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_barang);
        $stmt->execute();

        $affected_rows = $stmt->affected_rows;
        return $affected_rows;
    }

    public static function getCartItemsBySessionId($session_id)
    {
        global $conn;

        $sql = "SELECT k.id_keranjang, k.id_barang, b.nama_barang, b.harga_jual, k.kuantitas
                FROM keranjang k
                JOIN barang b ON k.id_barang = b.id_barang
                WHERE k.session_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $items = array();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }

        return $items;
    }

    public static function clearCart($session_id)
    {
        global $conn;

        $sql = "DELETE FROM keranjang WHERE session_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $session_id);
        return $stmt->execute();
    }
}
