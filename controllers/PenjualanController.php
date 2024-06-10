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
        // Ambil session_id dari session
        $session_id = session_id();

        // Ambil data keranjang berdasarkan session_id
        $keranjangItems = Cart::getCartItemsBySessionId($session_id);

        // Jika keranjang tidak kosong
        if (!empty($keranjangItems)) {
            // Ambil id_user dari session atau form atau lainnya
            $id_user = $_SESSION['user']['id_user'];

            // Hitung total harga
            $total_harga = 0;
            foreach ($keranjangItems as $item) {
                $total_harga += $item['kuantitas'] * $item['harga_jual'];
            }

            // Ambil tanggal penjualan dari input form
            $tanggal_penjualan = $_POST['tanggal_penjualan'];

            // Simpan data ke tabel penjualan
            $id_penjualan = Penjualan::store($id_user, $total_harga, $tanggal_penjualan);

            // Jika penjualan berhasil disimpan
            if ($id_penjualan) {
                // Simpan detail penjualan ke tabel detail_penjualan
                foreach ($keranjangItems as $item) {
                    DetailPenjualan::store(
                        $id_penjualan,
                        $item['id_barang'],
                        $item['kuantitas'],
                        $item['harga_jual']
                    );
                }

                // Kosongkan keranjang
                Cart::clearCart($session_id);

                // Berikan respon sukses
                echo json_encode(['success' => true, 'message' => 'Checkout berhasil dilakukan.']);
            } else {
                // Berikan respon gagal
                echo json_encode(['success' => false, 'message' => 'Gagal melakukan checkout.']);
            }
        } else {
            // Berikan respon keranjang kosong
            echo json_encode(['success' => false, 'message' => 'Keranjang belanja kosong.']);
        }
    }
}
