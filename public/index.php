<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/BrandController.php';

$controller = new ProductController();
$brandController = new BrandController();

$action = $_GET['action'] ?? 'index';

if ($action == "create") {
    $controller->create();
    $brandController->create();
}
elseif ($action == "store") {
    $controller->store();
    $brandController->store();
}
elseif ($action == "edit") {
    $controller->edit();
    $brandController->edit();
}
elseif ($action == "update") {
    $controller->update();
    $brandController->update();
}
elseif ($action == "delete") {
    $controller->delete();
    $brandController->delete();
}
else {
    $controller->index(); // default page
    $brandController->index();
}