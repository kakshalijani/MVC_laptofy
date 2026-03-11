<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../core/Auth.php';

class DashboardController
{
    public function __construct()
    {
        Auth::requireLogin();
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