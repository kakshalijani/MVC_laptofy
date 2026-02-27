<?php
require_once __DIR__ . '/../app/controllers/ProductController.php';

$controller = new ProductController();

$action = $_GET['action'] ?? 'index';

if ($action == "create") {
    $controller->create();
}
elseif ($action == "store") {
    $controller->store();
}
elseif ($action == "edit") {
    $controller->edit();
}
elseif ($action == "update") {
    $controller->update();
}
elseif ($action == "delete") {
    $controller->delete();
}
else {
    $controller->index(); // default page
}