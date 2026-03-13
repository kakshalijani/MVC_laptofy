<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class HomeController {

    public function index() {

        $productModel = new Product();
        $brandModel = new Brand();

        // Pagination settings
        $limit = 5;

        // Current page
        $page = $_GET['page'] ?? 1;

        // Offset calculation
        $offset = ($page - 1) * $limit;

        // Get products with limit
        $products = $productModel->getProductsPaginated($limit,$offset);

        // Get total products
        $totalProducts = $productModel->getTotalProducts();

        // Total pages
        $totalPages = ceil($totalProducts / $limit);

        // Get brands
        $brands = $brandModel->getAll();

        require __DIR__.'/../views/user/index.php';
    }

    public function show()
    {
        $id = $_GET['id'];

        $productModel = new Product();

        $product = $productModel->getById($id);

        require __DIR__ . '/../views/user/show.php';
    }

    public function filter()
    {
        $keyword = $_GET['keyword'] ?? '';
        $brand_id = $_GET['brand_id'] ?? '';

        $productModel = new Product();

        $products = $productModel->filterProducts($keyword,$brand_id);

        require __DIR__ . '/../views/products/product_cards.php';
    }
}