<?php 

// landing
Router::url('', 'get', 'BerandaController::index');

// auth
Router::url('login', 'get', 'AuthController::login');
Router::url('login', 'post', 'AuthController::loginProses');
Router::url('register', 'get', 'AuthController::registerAs');
Router::url('register/manager', 'get', 'AuthController::registerManager');
Router::url('register/stoker', 'get', 'AuthController::registerStoker');
Router::url('register/kasir', 'get', 'AuthController::registerKasir');
Router::url('register', 'post', 'AuthController::registerProses');

// dashboard manager
Router::url('dashboard/manager', 'get', 'DashboardController::manager');

