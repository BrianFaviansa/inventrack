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

        <h2 class="text-4xl mb-4 font-bold dark:text-white">Jumlah Barang Berdasarkan Kategori</h2>

        <div class="graphContainer w-[80%] bg-white shadow-xl p-4 rounded-2xl" style="width: 80%; background-color: white; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); padding: 4px; border-radius: 20px;">
            <canvas id="myChart"></canvas>
        </div>
        <?php
        $kategori = [];

        foreach ($kategoris as $kategoriData) {
            $kategori[$kategoriData['id_kategori']] = [];
        }

        foreach ($barangs as $barang) {
            $idKategori = $barang['id_kategori'];
            if (isset($kategori[$idKategori])) {
                $kategori[$idKategori][] = $barang;
            }
        }
        ?>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    <?php foreach ($kategoris as $kategoriData) { ?> '<?= $kategoriData['nama_kategori'] ?>',
                    <?php } ?>
                ],
                datasets: [{
                    label: 'Jumlah Barang',
                    data: [
                        <?php
                        foreach ($kategori as $items) {
                            echo count($items) . ', ';
                        }
                        ?>
                    ],
                    backgroundColor: [
                        'lightblue',
                        'lightgreen',
                        'lightyellow',
                        'lightcoral',
                        'rgba(238,130,238)',
                        'lightgray'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 182, 193, 1)',
                        'rgba(211, 211, 211, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Math.round(value);
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    });
</script>