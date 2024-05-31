<?php 

Router::url('', 'get', 'LandingController::index');
Router::url('about', 'get', 'LandingController::about');

new Router();