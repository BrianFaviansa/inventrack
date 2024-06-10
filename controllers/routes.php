<?php 

// landing
Router::url('', 'get', 'AuthController::index');

// auth
Router::url('login', 'get', 'AuthController::login');
Router::url('sessionLogin', 'post', 'AuthController::sessionLogin');
Router::url('register', 'get', 'AuthController::registerAs');
Router::url('register/manager', 'get', 'AuthController::registerManager');
Router::url('register/stoker', 'get', 'AuthController::registerStoker');
Router::url('register/kasir', 'get', 'AuthController::registerKasir');
Router::url('register', 'post', 'AuthController::registerProses');
Router::url('logout', 'get', 'AuthController::logout');


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
Router::url('updateBarang', 'post', 'BarangController::edit');
Router::url('destroyBarang', 'post', 'BarangController::delete');

// dashboard manager - transaksi
Router::url('dashboard-manager/transaksi', 'get', 'ManagerController::transaksi');

// dashboard manager - keranjang
Router::url('dashboard-manager/keranjang', 'get', 'ManagerController::keranjang');
Router::url('Transaksi/addToCart', 'post', 'CartController::addToCart');
Router::url('Transaksi/updateCartQuantity', 'post', 'CartController::updateCartQuantity');
Router::url('Transaksi/deleteCartItem', 'post', 'CartController::deleteCartItem');
Router::url('Transaksi/checkout', 'post', 'PenjualanController::checkout');

// dashboard manager - statistik
Router::url('dashboard-manager/statistik', 'get', 'ManagerController::statistik');

// dashboard stoker
Router::url('dashboard-stoker', 'get', 'StokerController::index');
Router::url('dashboard-stoker/kategori', 'get', 'StokerController::kategori');
Router::url('dashboard-stoker/barang', 'get', 'StokerController::barang');

// dashboard kasir
Router::url('dashboard-kasir', 'get', 'KasirController::index');
Router::url('dashboard-kasir/transaksi', 'get', 'KasirController::transaksi');
Router::url('dashboard-kasir/keranjang', 'get', 'KasirController::keranjang');

// restricted
Router::url('restricted', 'get', 'AuthController::restricted');