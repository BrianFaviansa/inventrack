<?php $title = 'Inventrack | Dashboard Manager'; ?>

<div class="dark:bg-gray-800">
    <div class="pt-28 container mx-auto">
        <div class="mb-12 grid gap-y-10 gap-x-6 md:grid-cols-2 xl:grid-cols-4">
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 shadow-md">
                <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-blue-600 to-blue-400 text-white shadow-blue-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <i class="fa-solid fa-list-ul text-xl"></i>
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600 dark:text-gray-300">Total Kategori</p>
                    <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900 dark:text-gray-100"><?= $totalKategori; ?></h4>
                </div>
                <div class="border-t border-blue-gray-50 dark:border-gray-600 p-4">
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 shadow-md">
                <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-pink-600 to-pink-400 text-white shadow-pink-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600 dark:text-gray-300">Total Barang</p>
                    <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900 dark:text-gray-100"><?= $totalBarang; ?></h4>
                </div>
                <div class="border-t border-blue-gray-50 dark:border-gray-600 p-4">
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 shadow-md">
                <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-green-600 to-green-400 text-white shadow-green-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <i class="fa-solid fa-users fa-xl"></i>
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600 dark:text-gray-300">Total Pengguna</p>
                    <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900 dark:text-gray-100"><?= $totalUser; ?></h4>
                </div>
                <div class="border-t border-blue-gray-50 dark:border-gray-600 p-4">
                </div>
            </div>
            <div class="relative flex flex-col bg-clip-border rounded-xl bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 shadow-md">
                <div class="bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-orange-600 to-orange-400 text-white shadow-orange-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center">
                    <i class="fa-solid fa-cash-register fa-xl"></i>
                </div>
                <div class="p-4 text-right">
                    <p class="block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600 dark:text-gray-300">Total Penjualan</p>
                    <h4 class="block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900 dark:text-gray-100"><?= $totalPenjualan; ?></h4>
                </div>
                <div class="border-t border-blue-gray-50 dark:border-gray-600 p-4">
                </div>
            </div>
        </div>
    </div>
</div>
