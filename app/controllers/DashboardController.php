<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class DashboardController
{
    public function index()
    {
        $productModel = new Product();
        $brandModel = new Brand();

        $totalProducts = $productModel->getTotalProducts();
        $totalBrands = $brandModel->getTotalBrands();

        // view to load inside layout
        $view = __DIR__ . '/../views/dashboard/index.php';

        // load layout
        require __DIR__ . '/../views/admin/layout.php';
    }
}