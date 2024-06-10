<?php $title = 'Inventrack | Keranjang'; ?>

<section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang</h2>
        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
            <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                <?php if (empty($belanjaans)) : ?>
                    <p>Keranjang belanjaan kosong</p>
                <?php else : ?>
                    <?php foreach ($belanjaans as $index => $belanjaan) : ?>
                        <div class="space-y-6 my-3">
                            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <img class="h-20 w-20" src="<?= urlpath('assets/storage/barang_images/' . $belanjaan['gambar']); ?>" alt="<?= htmlspecialchars($belanjaan['nama_barang']); ?>" />
                                    <label for="counter-input-<?= $index ?>" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button type="button" data-decrement="<?= $index ?>" class="decrement-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="counter-input-<?= $index ?>" class="counter-input w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="<?= $belanjaan['kuantitas']; ?>" data-price="<?= $belanjaan['harga_jual']; ?>" data-id="<?= $belanjaan['id_barang']; ?>" required />
                                            <button type="button" data-increment="<?= $index ?>" class="increment-button inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="item-total text-base font-bold text-gray-900 dark:text-white" data-item-total=""><?= $belanjaan['kuantitas'] * $belanjaan['harga_jual']; ?></p>
                                        </div>
                                    </div>
                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <p class="text-base font-medium text-gray-900 dark:text-white"><?= $belanjaan['nama_barang']; ?></p>
                                        <button type="button" class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                            <svg class="me-1.5 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Order summary</p>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <!-- Other order summary details can go here -->
                        </div>
                        <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white" id="order-total">$8,191.00</dd>
                        </dl>
                    </div>
                    <a href="#" class="flex w-full items-center justify-center rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Proceed to Checkout</a>
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400"> or </span>
                        <a href="<?= urlpath('dashboard-manager/transaksi'); ?>" title="" class="inline-flex items-center gap-2 text-sm font-medium text-blue-700 underline hover:no-underline dark:text-blue-500">
                            Continue Shopping
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function() {
        function updateItemTotal(index) {
            var quantity = parseInt($('#counter-input-' + index).val());
            var price = parseFloat($('#counter-input-' + index).data('price'));
            var total = quantity * price;
            $('#counter-input-' + index).closest('.flex.items-center').find('[data-item-total]').text('Rp ' + total.toFixed(2));
        }

        function updateOrderTotal() {
            var orderTotal = 0;
            $('[data-item-total]').each(function() {
                orderTotal += parseFloat($(this).text().replace('Rp ', ''));
            });
            $('#order-total').text('Rp ' + orderTotal.toFixed(2));
        }

        function updateCartInDatabase(id_barang, kuantitas) {
            $.ajax({
                url: '/inventrack/Transaksi/updateCartQuantity',
                method: 'POST',
                data: {
                    id_barang: id_barang,
                    kuantitas: kuantitas
                },
                success: function(response) {
                    var jsonResponse = response;
                    if (typeof response === 'string') {
                        try {
                            jsonResponse = JSON.parse(response);
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            return;
                        }
                    }

                    if (jsonResponse.success) {
                        // Eksekusi skrip SweetAlert dari respons server
                        eval(jsonResponse.script);

                        // Memperbarui total pesanan
                        updateOrderTotal();
                    } else {
                        console.error('Error updating cart:', jsonResponse.message);
                    }
                },
            });
        }


        $('.increment-button').click(function() {
            var index = $(this).data('increment');
            var input = $('#counter-input-' + index);
            var currentValue = parseInt(input.val());
            input.val(currentValue + 1);

            var id_barang = input.data('id'); // Make sure the data-id attribute is set on the input element
            var newQuantity = currentValue + 1;
            updateCartInDatabase(id_barang, newQuantity);

            updateItemTotal(index);
            updateOrderTotal();
        });

        $('.decrement-button').click(function() {
            var index = $(this).data('decrement');
            var input = $('#counter-input-' + index);
            var currentValue = parseInt(input.val());
            if (currentValue > 1) {
                input.val(currentValue - 1);

                var id_barang = input.data('id'); // Make sure the data-id attribute is set on the input element
                var newQuantity = currentValue - 1;
                updateCartInDatabase(id_barang, newQuantity);

                updateItemTotal(index);
                updateOrderTotal();
            }
        });

        // Initial calculation
        $('[data-item-total]').each(function(index) {
            updateItemTotal(index);
        });
        updateOrderTotal();
    });
</script>