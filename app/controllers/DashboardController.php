<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class DashboardController
{
    public function index()
    {
        $product = new Product();
        $brand = new Brand();

        $totalProducts = $product->getTotalProducts();
        $totalBrands = $brand->getTotalBrands();

        $page = 'dashboard';

        require __DIR__ . '/../views/dashboard/index.php';
    }
}