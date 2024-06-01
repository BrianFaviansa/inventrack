<?php 

// landing
Router::url('', 'get', 'LandingController::index');

// auth
Router::url('login', 'get', 'AuthController::login');


