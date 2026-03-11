<?php
session_start();

// Load Configuration
require_once __DIR__ . '/../app/config/config.php';

// Load Router
require_once __DIR__ . '/../app/core/Router.php';

// Start Router
$router = new Router();
$router->route();