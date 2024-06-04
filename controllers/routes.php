<?php 

// landing
Router::url('', 'get', 'BerandaController::index');

// auth
Router::url('login', 'get', 'AuthController::login');
Router::url('login', 'post', 'AuthController::sessionLogin');
Router::url('register', 'get', 'AuthController::registerAs');
Router::url('register/manager', 'get', 'AuthController::registerManager');
Router::url('register/stoker', 'get', 'AuthController::registerStoker');
Router::url('register/kasir', 'get', 'AuthController::registerKasir');
Router::url('register', 'post', 'AuthController::registerProses');

// dashboard manager
Router::url('dashboard-manager', 'get', 'ManagerController::index');

// dashboard manager - kategori
Router::url('dashboard-manager/kategori', 'get', 'ManagerController::kategori');
Router::url('storeKategori', 'post', 'KategoriController::create');
Router::url('updateKategori', 'post', 'KategoriController::edit');
Router::url('destroyKategori', 'post', 'KategoriController::delete');

// dashboard manager - barang
Router::url('dashboard-manager/barang', 'get', 'ManagerController::barang');    
Router::url('storeBarang', 'post', 'BarangController::create');

// dashboard stoker
Router::url('dashboard-stoker', 'get', 'StokerController::index');

// dashboard kasir
Router::url('dashboard-kasir', 'get', 'KasirController::index');

// restricted
Router::url('restricted', 'get', 'AuthController::restricted');