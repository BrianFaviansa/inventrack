<?php $title = 'Inventrack | Transaksi'; ?>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 mt-28 container mx-auto">
    <?php foreach ($barangs as $barang) : ?>
        <div class="w-full max-w-96 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-center">
                <img class="p-8 flex max-h-60 rounded-t-lg" src="<?= urlpath('assets/storage/barang_images/' . $barang['gambar']); ?>" alt="<?= htmlspecialchars($barang['nama_barang']); ?>" />
            </div>
            <div class="px-5 pb-5 h-full">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?= $barang['nama_barang']; ?></h5>
                <div class="flex items-end justify-between">
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Rp <?= $barang['harga_jual']; ?></span>

                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 add-to-cart" data-id="<?= $barang['id_barang']; ?>">Tambah ke keranjang</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    $(document).ready(function() {
        $('.add-to-cart').click(function() {
            var barangId = $(this).data('id');

            $.ajax({
                url: '<?= urlpath('addToCart'); ?>',
                method: 'POST',
                data: {
                    id_barang: barangId
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menambahkan barang ke keranjang.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>