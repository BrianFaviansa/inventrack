<?php
include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/Cart.php';

class CartController
{
    public static function addToCart()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_barang = $_POST['id_barang'];
            $session_id = session_id();

            $result = Cart::store($id_barang, $session_id);

            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Barang berhasil ditambahkan ke keranjang.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal menambahkan barang ke keranjang.'
                ];
            }

            echo json_encode($response);
        }
    }

    public static function updateCartQuantity()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_barang = $_POST['id_barang'];
            $kuantitas = $_POST['kuantitas'];
            $session_id = session_id();


            $result = Cart::updateQuantity($id_barang, $session_id, $kuantitas);

            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Kuantitas berhasil diperbarui.',
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal memperbarui kuantitas.'
                ];
            }
            echo json_encode($response);
        }
    }

    public static function deleteCartItem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_barang = $_POST['id_barang'];

            $deleted = Cart::deleteItem($id_barang);

            if ($deleted) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Gagal menghapus item dari keranjang.'));
            }
        } else {
            http_response_code(404);
        }
    }

}
