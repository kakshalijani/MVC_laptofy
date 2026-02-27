<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {

    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    // 🔹 Show all products
    public function index() {
        $products = $this->product->getAll();
        require __DIR__ . '/../views/products/index.php';
    }

    // 🔹 Show create form
    public function create() {
        require_once __DIR__ . '/../models/Brand.php';
        $brandModel = new Brand();
        $brands = $brandModel->getAll();
        require __DIR__ . '/../views/products/create.php';
    }

    // 🔹 Store data
    public function store() {

    $name        = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $price       = $_POST['price'] ?? 0;
    $status      = $_POST['status'] ?? 'active';
    $brand_id    = $_POST['brand_id'] ?? null; // ✅ SAFETY CHECK

    // safety check
    if (empty($brand_id)) {
        die("Brand is required");
    }

    // IMAGE UPLOAD (MULTIPLE)
    $images = [];

    if (!empty($_FILES['img']['name'][0])) {
        foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {
            $filename = time() . '_' . $_FILES['img']['name'][$key];
            move_uploaded_file($tmp, __DIR__ . '/../../public/img/' . $filename);
            $images[] = $filename;
        }
    }

    $imgString = implode(',', $images);

    $this->product->insert(
        $name,
        $description,
        $price,
        $status,
        $brand_id,   //  NOW VALID
        $imgString
    );

    header("Location: index.php?action=index");
}
    // 🔹 Edit form
    public function edit() {
        require_once __DIR__ . '/../models/Brand.php';
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);
        $brandModel = new Brand();
        $brands = $brandModel->getAll();

        require __DIR__ . '/../views/products/edit.php';
    }

    // 🔹 Update
    public function update() {

        $id     = $_POST['id'];
        $name   = $_POST['name'];
        $description   = $_POST['description'];
        $price  = $_POST['price'];
        $status = $_POST['status'];
        $brand_id    = $_POST['brand_id'] ?? 'null';

        $img = $_FILES['img']['name']??'';
        $tmp = $_FILES['img']['tmp_name']??'';

        if(!empty($img)){
            move_uploaded_file($tmp, __DIR__ . '/../../public/img/'.$img);
        } else {
            $old = $this->product->getById($id);
            $data = mysqli_fetch_assoc($old);
            $img = $data['img'];
        }

        $this->product->update($id,$name,$description,$price,$status,$img,$brand_id);
        header("Location: index.php");
        exit();
    }

    // 🔹 Delete
    public function delete() {
        $id = $_GET['id'];
        $this->product->delete($id);
        header("Location: index.php");
        exit();
    }
    public function show() {
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);
        require __DIR__ . '/../views/products/show.php';
    }
}