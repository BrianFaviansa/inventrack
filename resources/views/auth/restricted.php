<?php $title='Restricted'; ?>

<div class="min-h-screen bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-6xl font-extrabold text-gray-800 dark:text-gray-200">403</h1>
        <p class="mt-2 text-2xl font-semibold text-gray-600 dark:text-gray-300">Terlarang</p>
        <p class="mt-4 text-gray-600 dark:text-gray-400">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="<?= urlpath(''); ?>" class="mt-6 inline-block px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
            Kembali ke beranda
        </a>
    </div>
</div>
