<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../core/Auth.php';

class ProductController
{
    private Product $product;

    public function __construct()
    {
        Auth::requireLogin();
        $this->product = new Product();
        
    }

    public function index(): void
    {
        $products = $this->product->getAll();
        $view = __DIR__ . '/../views/products/index.php';
        require __DIR__ . '/../views/admin/layout.php';
        
    }

    public function create(): void
    {
        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        $view =__DIR__ . '/../views/products/create.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

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

        if ($this->product->productExists($name)) {
            echo "<script>
            alert('Brand already exists');
            window.location='/laptofy_MVC/addproduct';
            </script>";
            exit;
        }

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

    public function edit(): void
    {
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            die("Invalid Product ID");
        }

        $product = $this->product->getById($id);   

        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        $view = __DIR__ . '/../views/products/edit.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

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

        $oldData = $this->product->getById($id);

        $existingImages = !empty($oldData['img']) ? explode(',', $oldData['img']) : [];

        if (!empty($_POST['delete_img'])) {

            foreach ($_POST['delete_img'] as $deleteImg) {

                $path = __DIR__ . '/../../public/img/product/' . $deleteImg;

                if (file_exists($path)) {
                    unlink($path);
                }

                $existingImages = array_diff($existingImages, [$deleteImg]);
            }
        }

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

    public function show(): void
    {
        $id = intval($_GET['id'] ?? 0);

        if (!$id) {
            die("Invalid Product ID");
        }

        $product = $this->product->getById($id);

        $view=__DIR__ . '/../views/products/show.php';
        require __DIR__ . '/../views/admin/layout.php';
    }
    
}