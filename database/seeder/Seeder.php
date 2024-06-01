<?php
require_once '../../app/config/env.php';
require_once '../../app/config/conn.php';
require_once 'RoleSeeder.php';
require_once 'PenggunaSeeder.php';
require_once 'KategoriSeeder.php';

$conn = require '../../app/config/conn.php';

$roleSeeder = new RoleSeeder($conn);
$roleSeeder->run();

$penggunaSeeder = new PenggunaSeeder($conn);
$penggunaSeeder->run();

$kategoriSeeder = new KategoriSeeder($conn);
$kategoriSeeder->run();

echo "Database seeding completed.";

$conn->close();
