<?php 

// landing
Router::url('', 'get', 'BerandaController::index');

// auth
Router::url('login', 'get', 'AuthController::login');

Router::url('register', 'get', 'AuthController::register');
Router::url('register', 'post', 'AuthController::registerProses');
