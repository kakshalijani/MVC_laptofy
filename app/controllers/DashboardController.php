<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../core/Auth.php';

class DashboardController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['user'])){
            header("location: /laptofy_mvc/login");
            exit();
        }

        $this->product = new Product();
    }
    public function index()
    {

        $productModel = new Product();
        $brandModel = new Brand();

        $totalProducts = $productModel->getTotalProducts();
        $totalBrands = $brandModel->getTotalBrands();

        $view = __DIR__ . '/../views/dashboard/index.php';

        require __DIR__ . '/../views/admin/layout.php';
    }
}