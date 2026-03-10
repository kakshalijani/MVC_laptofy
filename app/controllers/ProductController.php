<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../core/Auth.php';

class ProductController
{
    private Product $product;

    public function __construct()
    {
        // Start session first
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Protect all product pages
        Auth::requireLogin();

        $this->product = new Product();
    }

    // Show all products
    public function index(): void
    {
        $products = $this->product->getAll();
        require __DIR__ . '/../views/products/index.php';
    }

    // Show create form
    public function create(): void
    {
        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        require __DIR__ . '/../views/products/create.php';
    }

    // Store new product
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/productlist");
            exit;
        }

        $name        = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price       = floatval($_POST['price'] ?? 0);
        $status      = $_POST['status'] ?? 'active';
        $brand_id    = intval($_POST['brand_id'] ?? 0);

        if (empty($name)) {
            die("Product name is required");
        }

        // Check duplicate product
        if ($this->product->productExists($name)) {
            echo "<script>alert('Product already exists!');</script>";
            header("Location: /laptofy_MVC/addproduct");
            exit;
        }

        // Upload Images
        $images = [];
        $allowed = ['jpg','jpeg','png','webp'];

        if (!empty($_FILES['img']['name'][0])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

                if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) continue;

                $ext = strtolower(pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION));

                if (!in_array($ext, $allowed)) continue;

                $filename = uniqid('product_', true) . '.' . $ext;

                move_uploaded_file(
                    $tmp,
                    __DIR__ . '/../../public/img/product/' . $filename
                );

                $images[] = $filename;
            }
        }

        $this->product->insert(
            $name,
            $description,
            $price,
            $status,
            $brand_id,
            implode(',', $images)
        );

        header("Location: /laptofy_MVC/productlist");
        exit;
    }

    // Show edit form
    public function edit(): void
    {
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            die("Invalid Product ID");
        }

        $result = $this->product->getById($id);
        $product = $result->fetch_assoc();

        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        require __DIR__ . '/../views/products/edit.php';
    }

    // Update product
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/productlist");
            exit;
        }

        $id          = intval($_POST['id'] ?? 0);
        $name        = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price       = floatval($_POST['price'] ?? 0);
        $status      = $_POST['status'] ?? 'active';
        $brand_id    = intval($_POST['brand_id'] ?? 0);

        $oldResult = $this->product->getById($id);
        $oldData = $oldResult->fetch_assoc();

        $existingImages = !empty($oldData['img']) ? explode(',', $oldData['img']) : [];

        // Delete selected images
        if (!empty($_POST['delete_img'])) {

            foreach ($_POST['delete_img'] as $deleteImg) {

                $path = __DIR__ . '/../../public/img/product/' . $deleteImg;

                if (file_exists($path)) {
                    unlink($path);
                }

                $existingImages = array_diff($existingImages, [$deleteImg]);
            }
        }

        // Upload new images
        $allowed = ['jpg','jpeg','png','webp'];

        if (!empty($_FILES['img']['name'][0])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

                if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) continue;

                $ext = strtolower(pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION));

                if (!in_array($ext, $allowed)) continue;

                $filename = uniqid('product_', true) . '.' . $ext;

                move_uploaded_file(
                    $tmp,
                    __DIR__ . '/../../public/img/product/' . $filename
                );

                $existingImages[] = $filename;
            }
        }

        $this->product->update(
            $id,
            $name,
            $description,
            $price,
            $status,
            implode(',', $existingImages),
            $brand_id
        );

        header("Location: /laptofy_MVC/productlist");
        exit;
    }

    // Delete product
    public function delete(): void
    {
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            die("Invalid request");
        }

        $this->product->delete($id);

        header("Location: /laptofy_MVC/productlist");
        exit;
    }

    // View single product
    public function show(): void
    {
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            die("Invalid Product ID");
        }

        $result = $this->product->getById($id);
        $product = $result->fetch_assoc();

        require __DIR__ . '/../views/products/show.php';
    }
}