<?php $title = 'Inventrack | Dashboard Manager'; ?>

<div class="dark:bg-gray-800">
    <div class="pt-28 container mx-auto">
        <h2 class="text-4xl mb-4 font-bold dark:text-white">Statistik Penjualan</h2>
    </div>
    <canvas id="penjualanChart"></canvas>
</div>

<script>
    var ctx = document.getElementById('penjualanChart').getContext('2d');
    var penjualanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [
                <?php
                foreach ($statistiks as $row) {
                    echo "'" . $row['tanggal_penjualan'] . "',";
                }
                ?>
            ],
            datasets: [{
                label: 'Penjualan',
                data: [
                    <?php
                    foreach ($statistiks as $row) {
                        echo $row['total_penjualan'] . ",";
                    }
                    ?>
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>