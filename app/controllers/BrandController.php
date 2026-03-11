<?php

require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../core/Auth.php';

class BrandController
{
    private Brand $brand;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['user'])){
            header("location: /laptofy_mvc/login");
            exit();
        }

        $this->brand = new brand();
    }

    public function index(): void
    {
        $brands = $this->brand->getAll();
        $view=__DIR__ . '/../views/brand/index.php';
        require __DIR__ . '/../views/admin/layout.php';

    }

    public function create(): void
    {
        $view =__DIR__ . '/../views/brand/create.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/brandlist");
            exit;
        }

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            die("Brand name is required");
        }

        if ($this->brand->brandExists($name)) {
            echo "<script>
            alert('Brand already exists');
            window.location='/laptofy_MVC/addbrand';
            </script>";
            exit;
        }

        $images = [];

        if (!empty($_FILES['img']['name'][0])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

                if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) {
                    continue;
                }

                $ext = strtolower(pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION));

                $allowed = ['jpg','jpeg','png','webp'];

                if (!in_array($ext, $allowed)) {
                    continue;
                }

                $filename = uniqid('brand_', true) . '.' . $ext;

                $uploadPath = __DIR__ . '/../../public/img/brand/' . $filename;

                move_uploaded_file($tmp, $uploadPath);

                $images[] = $filename;
            }
        }

        $this->brand->create($name, implode(',', $images));

        header("Location: /laptofy_MVC/brandlist");
        exit;
    }

    public function edit(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid Brand ID");
        }

        $brand = $this->brand->getById((int)$id);

        if (!$brand) {
            die("Brand not found");
        }

        $view=__DIR__ . '/../views/brand/edit.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/brandlist");
            exit;
        }

        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');

        if (!$id || $name === '') {
            die("Invalid data");
        }

        $brand = $this->brand->getById((int)$id);

        if (!$brand) {
            die("Brand not found");
        }

        $existingImages = !empty($brand['img']) ? explode(',', $brand['img']) : [];

        if (!empty($_POST['delete_img'])) {

            foreach ($_POST['delete_img'] as $img) {

                $path = __DIR__ . '/../../public/img/brand/' . $img;

                if (file_exists($path)) {
                    unlink($path);
                }

                $existingImages = array_diff($existingImages, [$img]);
            }
        }

        if (!empty($_FILES['img']['name'][0])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

                if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) {
                    continue;
                }

                $ext = strtolower(pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION));

                $allowed = ['jpg','jpeg','png','webp'];

                if (!in_array($ext, $allowed)) {
                    continue;
                }

                $filename = uniqid('brand_', true) . '.' . $ext;

                move_uploaded_file($tmp, __DIR__ . '/../../public/img/brand/' . $filename);

                $existingImages[] = $filename;
            }
        }

        $this->brand->update($id, $name, implode(',', $existingImages));

        header("Location: /laptofy_MVC/brandlist");
        exit;
    }

    public function show(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid Brand ID");
        }

        $brand = $this->brand->getById((int)$id);

        if (!$brand) {
            die("Brand not found");
        }

        $view=__DIR__ . '/../views/brand/show.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function delete(): void
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid request");
        }

        $brand = $this->brand->getById((int)$id);

        if (!$brand) {
            die("Brand not found");
        }

        if (!empty($brand['img'])) {

            foreach (explode(',', $brand['img']) as $img) {

                $path = __DIR__ . '/../../public/img/brand/' . trim($img);

                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $this->brand->delete((int)$id);

        header("Location: /laptofy_MVC/brandlist");
        exit;
    }
}