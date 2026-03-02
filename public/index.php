<?php
require_once __DIR__ . '/../app/controllers/BrandController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';

$brandController = new BrandController();
$productController = new ProductController();
$dashboardController = new DashboardController();

$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';

if ($controller == "brand") {
    if ($action == "create") {
        $brandController->create();
    }
    elseif ($action == "store") {
        $brandController->store();
    }
    elseif ($action == "edit") {
        $brandController->edit();
    }
    elseif ($action == "update") {
        $brandController->update();
    }
    elseif ($action == "delete") {
        $brandController->delete();
    }
    elseif ($action == "show") {
        $brandController->show();
    }
    else {
        $brandController->index(); // default page
    }
}
elseif ($controller == "product") {
    if ($action == "create") {
        $productController->create();
    }
    elseif ($action == "store") {
        $productController->store();
    }
    elseif ($action == "edit") {
        $productController->edit();
    }
    elseif ($action == "update") {
        $productController->update();
    }
    elseif ($action == "delete") {
        $productController->delete();
    }
    elseif ($action == "show") {
        $productController->show();
    }
    else {
        $productController->index(); // default page
    }
}
else {
    // default to dashboard
    $dashboardController->index();
}
