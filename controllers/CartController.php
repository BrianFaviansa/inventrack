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

            // Lakukan operasi penambahan barang ke keranjang di sini
            $result = Cart::store($id_barang);

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
        } else {
            // Jika bukan permintaan POST, kembalikan respons yang sesuai
            http_response_code(405); // Method Not Allowed
            echo 'Metode tidak diizinkan';
        }
    }
}
