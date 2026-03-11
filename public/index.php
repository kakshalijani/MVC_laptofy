<?php

//if(session_status() === PHP_SESSION_NONE) {
    session_start();
//}
//if(!isset($_SESSION['user'])){
    //header("location: /laptofy_mvc/login");
    //exit();
//}

// Load Configuration
require_once __DIR__ . '/../app/config/config.php';

// Load Router
require_once __DIR__ . '/../app/core/Router.php';

// Start Router
$router = new Router();
$router->route();