<?php
require_once '../../app/config/env.php';
require_once '../../app/config/conn.php';
require_once 'RoleSeeder.php';
require_once 'UserSeeder.php';
require_once 'KategoriSeeder.php';

$conn = require '../../app/config/conn.php';

$roleSeeder = new RoleSeeder($conn);
$roleSeeder->run();

$userSeeder = new UserSeeder($conn);
$userSeeder->run();

$kategoriSeeder = new KategoriSeeder($conn);
$kategoriSeeder->run();

echo "Database seeding completed.";

$conn->close();
