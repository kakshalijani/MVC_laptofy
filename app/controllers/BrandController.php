<?php
require_once __DIR__ . '/../models/Brand.php';

class BrandController {

    private Brand $brand;

    public function __construct() {
        $this->brand = new Brand();
    }

    // 🔹 Show all brands
    public function index() {
        $brand = $this->brand->getAll();
        require __DIR__ . '/../views/brand/index.php';
    }

    // 🔹 Show create form
    public function create() {
        require __DIR__ . '/../views/brand/create.php';
    }

    // 🔹 Store new brand
    public function store() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=brand&action=index');
            exit;
        }

        $name = trim($_POST['name'] ?? '');

        // ✅ CHECK BRAND EXISTS (MODEL METHOD)
        if ($this->brand->brandExists($name)) {
            echo "<script>
                    alert('Brand already exists!');
                    window.location.href='index.php?controller=brand&action=create';
                  </script>";
            exit;
        }

        // 📸 Upload images
        $images = [];

        if (!empty($_FILES['img']['name'][0])) {
            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {
                if (!empty($tmp)) {
                    $filename = uniqid() . '_' . basename($_FILES['img']['name'][$key]);
                    move_uploaded_file(
                        $tmp,
                        __DIR__ . '/../../public/img/brand/' . $filename
                    );
                    $images[] = $filename;
                }
            }
        }

        $this->brand->create($name, implode(',', $images));

        header('Location: /laptofy_MVC/public/index.php?controller=brand&action=index');
        exit;
    }

    // 🔹 Show edit form
    public function edit() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid brand ID");
        }

        $brand = $this->brand->getById($id);
        require __DIR__ . '/../views/brand/edit.php';
    }

    // 🔹 Update brand
    public function update()
    {
        $id   = $_POST['id'];
        $name = $_POST['name'];

    // Get existing brand data
        $brand = $this->brand->getById($id);
        $existingImages = [];

        if (!empty($brand['img'])) {
            $existingImages = explode(',', $brand['img']);
        }

    //Handle image deletion (checkbox)
        if (!empty($_POST['delete_img'])) {
            foreach ($_POST['delete_img'] as $deleteImg) {
                $path = __DIR__ . '/../../public/img/brand/' . $deleteImg;

                // remove file
                if (file_exists($path)) {
                    unlink($path);
                }

            // remove from existing images array
            $existingImages = array_diff($existingImages, [$deleteImg]);
        }
    }

    // Handle NEW image uploads (ADD, not replace)
        if (!empty($_FILES['img']['name'][0])) {

            foreach ($_FILES['img']['tmp_name'] as $key => $tmp) {

                if ($_FILES['img']['error'][$key] !== UPLOAD_ERR_OK) {
                    continue;
                }

                $ext = pathinfo($_FILES['img']['name'][$key], PATHINFO_EXTENSION);

                // unique filename (NO DUPLICATES)
                $filename = uniqid('brand_', true) . '.' . $ext;

                move_uploaded_file(
                    $tmp,
                    __DIR__ . '/../../public/img/brand/' . $filename
                );

                $existingImages[] = $filename; // 🔥 ADD to existing
            }
        }

        // Save updated data
        $this->brand->update(
            $id,
            $name,
            implode(',', $existingImages)
        );

        header('Location: /laptofy_MVC/public/index.php?controller=brand&action=index');
        exit;
    }
    // 🔹 Show single brand
    public function show() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid brand ID");
        }

        $brand = $this->brand->getById($id);
        require __DIR__ . '/../views/brand/show.php';
    }

    // 🔹 Delete brand
    public function delete() {

        $id = $_GET['id'] ?? null;

        if (!$id) {
            die("Invalid request");
        }

        $brand = $this->brand->getById($id);

        // 🧹 Delete images from folder
        if (!empty($brand['img'])) {
            foreach (explode(',', $brand['img']) as $img) {
                $path = __DIR__ . '/../../public/img/brand/' . trim($img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $this->brand->delete($id);

        header('Location: /laptofy_MVC/public/index.php?controller=brand&action=index');
        exit;
    }
}