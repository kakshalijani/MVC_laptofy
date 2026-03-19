<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class HomeController {

    public function index() {

        $productModel = new Product();
        $brandModel = new Brand();

        $limit = 1;

        $page = $_GET['page'] ?? 1;

        $offset = ($page - 1) * $limit;

        $products = $productModel->getProductsPaginated($limit,$offset);

        $totalProducts = $productModel->getTotalProducts();

        $totalPages = ceil($totalProducts / $limit);

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
        $keyword  = $_GET['keyword'] ?? '';
        $brand_id = $_GET['brand_id'] ?? '';
        $page     = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit    = 1;
        $offset   = ($page - 1) * $limit;

        $productModel = new Product();

        $products   = $productModel->filterProducts($keyword, $brand_id, $limit, $offset);
        $totalCount = $productModel->filterProductsCount($keyword, $brand_id);
        $totalPages = ceil($totalCount / $limit);

        require __DIR__ . '/../views/user/product_cards.php';
    }
    public function priceFilter()
    {
        $price = $_GET['price_range'] ?? ''; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 1;
        $offset = ($page - 1) * $limit; 

        $min = '';
        $max = '';
        if($price != ''){
            $prices = explode('-', $price);
            $min = $prices[0]; 
            $max = $prices[1];
        }

        $productModel = new Product(); 

        $products   = $productModel->filterByPrice($min, $max, $limit, $offset);
        $totalCount = $productModel->filterByPriceCount($min, $max); 
        $totalPages = ceil($totalCount / $limit); 
        require __DIR__ . '/../views/user/product_cards.php'; 
    }
}