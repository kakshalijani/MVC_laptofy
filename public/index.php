<?php
require_once '../app/controllers/ProductController.php';

$controller = new ProductController();

$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'index':
        $controller->index();
        break;

    case 'create':
        $controller->create();
        break;

    case 'store':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->store();
        }
        break;

    case 'edit':
        $controller->edit();
        break;

    case 'update':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->update();
        }
        break;

    case 'delete':
        $controller->delete();
        break;

    case 'show':
        $controller->show();
        break;

    default:
        $controller->index();
        break;
}

exit;