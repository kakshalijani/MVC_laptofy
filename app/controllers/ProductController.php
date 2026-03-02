<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';

class ProductController {

    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    // 🔹 Show all products
    public function index() {
        $products = $this->product->getactiveproducts();
        require __DIR__ . '/../views/products/index.php';
    }

    // 🔹 Show create form
    public function create() {
        $brandModel = new Brand();
        $brands = $brandModel->getAll();
        require __DIR__ . '/../views/products/create.php';
    }

    // 🔹 Store product
    public function store() {

        $name        = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price       = $_POST['price'] ?? 0;
        $status      = $_POST['status'] ?? 'active';
        $brand_id    = $_POST['brand_id'] ?? null;

        if ($this->product->productExists($name)) {
            echo '<script>
                    alert("Product already exists!");
                    window.location.href="index.php?controller=product&action=create";
                  </script>';
                  exit();
        }

        // MULTIPLE IMAGE UPLOAD
        $images = [];

        if (!empty($_FILES['img']['name'][0])) {
            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {
                $filename = uniqid() . '_' . $_FILES['img']['name'][$key];
                move_uploaded_file(
                    $tmp,
                    __DIR__ . '/../../public/img/product/' . $filename
                );
                $images[] = $filename;
            }
        }

        $imgString = implode(',', $images);

        $this->product->insert(
            $name,
            $description,
            $price,
            $status,
            $brand_id,
            $imgString
        );

        header("Location: /laptofy_MVC/public/index.php?controller=product&action=index");
        exit;
    }

    // 🔹 Show edit form
    public function edit() {

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Invalid Product ID");
        }

        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        require __DIR__ . '/../views/products/edit.php';
    }

    // 🔹 Update product
    public function update()
{
    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $status      = $_POST['status'];
    $brand_id    = $_POST['brand_id'];

    // 1️⃣ Get existing product
    $oldResult = $this->product->getById($id);
    $oldData   = mysqli_fetch_assoc($oldResult);

    $existingImages = [];
    if (!empty($oldData['img'])) {
        $existingImages = explode(',', $oldData['img']);
    }

    // 2️⃣ Delete selected images
    if (!empty($_POST['delete_img'])) {
        foreach ($_POST['delete_img'] as $deleteImg) {

            $path = __DIR__ . '/../../public/img/product/' . $deleteImg;

            if (file_exists($path)) {
                unlink($path);
            }

            $existingImages = array_diff($existingImages, [$deleteImg]);
        }
    }

    // 3️⃣ Add NEW images (NO DUPLICATES)
    if (!empty($_FILES['img']['name'][0])) {
        foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

            if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) {
                continue;
            }

            $ext = pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION);
            $filename = uniqid('product_', true) . '.' . $ext;

            move_uploaded_file(
                $tmp,
                __DIR__ . '/../../public/img/product/' . $filename
            );

            $existingImages[] = $filename;
        }
    }

    // 4️⃣ Update product
    $this->product->update(
        $id,
        $name,
        $description,
        $price,
        $status,
        implode(',', $existingImages),
        $brand_id
    );

    header("Location: /laptofy_MVC/public/index.php?controller=product&action=index");
    exit;
    }

    // 🔹 Delete product
    public function delete() {

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Invalid request");
        }

        $this->product->delete($id);

        header("Location: /laptofy_MVC/public/index.php?controller=product&action=index");
        exit;
    }

    // 🔹 View single product
    public function show() {

        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("Invalid Product ID");
        }

        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        require __DIR__ . '/../views/products/show.php';
    }
}