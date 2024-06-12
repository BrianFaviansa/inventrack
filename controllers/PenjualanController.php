<?php

include_once 'function/main.php';
include_once 'app/config/static.php';
include_once 'models/User.php';
include_once 'models/Kategori.php';
include_once 'models/Barang.php';
include_once 'models/Penjualan.php';
include_once 'models/Cart.php';
include_once 'models/DetailPenjualan.php';

class PenjualanController
{
    public static function checkout()
    {
        $session_id = session_id();

        $keranjangItems = Cart::getCartItemsBySessionId($session_id);

        if (!empty($keranjangItems)) {
            $id_user = $_SESSION['user']['id_user'];

            $total_harga = 0;
            foreach ($keranjangItems as $item) {
                $total_harga += $item['kuantitas'] * $item['harga_jual'];
            }

            $tanggal_penjualan = $_POST['tanggal_penjualan'];

            $id_penjualan = Penjualan::store($id_user, $total_harga, $tanggal_penjualan);

            if ($id_penjualan) {
                foreach ($keranjangItems as $item) {
                    DetailPenjualan::store(
                        $id_penjualan,
                        $item['id_barang'],
                        $item['kuantitas'],
                        $item['harga_jual']
                    );
                }

                Cart::clearCart($session_id);

                echo json_encode(['success' => true, 'message' => 'Checkout berhasil dilakukan.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal melakukan checkout.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Keranjang belanja kosong.']);
        }
    }
}
