<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        $products = $this->product->getAll();
        require __DIR__ . '/../views/products/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/products/create.php';
    }

    public function store()
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $img = $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "../public/img/" . $img);

        $this->product->insert($name, $description, $price, $status, $img);

        header("Location: index.php?action=index");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        require __DIR__ . '/../views/products/edit.php';
    }

    public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $result = $this->product->getById($id);
        $old = mysqli_fetch_assoc($result);

        $img = $old['img'];

        if (!empty($_FILES['img']['name'])) {
            $img = $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], "../public/img/" . $img);
        }

        $this->product->update($id, $name, $description, $price, $status, $img);

        header("Location: index.php?action=index");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->product->delete($id);
        header("Location: index.php?action=index");
        exit;
    }

    public function show()
    {
        $id = $_GET['id'];
        $result = $this->product->getById($id);
        $product = mysqli_fetch_assoc($result);

        require __DIR__ . '/../views/products/show.php';
    }
}