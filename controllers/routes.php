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
Router::url('storeKategori', 'post', 'KategoriController::store');
Router::url('updateKategori', 'post', 'KategoriController::update');
Router::url('destroyKategori', 'post', 'KategoriController::destroy');

// dashboard stoker
Router::url('dashboard-stoker', 'get', 'StokerController::index');

// dashboard kasir
Router::url('dashboard-kasir', 'get', 'KasirController::index');

// restricted
Router::url('restricted', 'get', 'AuthController::restricted');