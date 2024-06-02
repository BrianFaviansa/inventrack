<?php $title = 'Inventrack | Kategori'; ?>

<div class="mt-28 container mx-auto">
    <h1>Daftar Kategori</h1>

    <?= displayFlashSuccess('success'); ?>
    <?= displayFlashError('error'); ?>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Kategori
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kategoris as $kategori) : ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <?= $no; ?>
                        </th>
                        <td class="px-6 py-4">
                            <?= $kategori['nama_kategori']; ?>
                        </td>
                        <td class="px-6 py-4">
                            Edit | Hapus
                        </td>
                    </tr>
                <?php
                    $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>
</div>