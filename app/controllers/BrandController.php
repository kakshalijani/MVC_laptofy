//code for brandcontroller.php
<?php
require_once __DIR__ . '/../models/Brand.php';
class BrandController {
    private $brand;

    public function __construct() {
        $this->brand = new Brand();
    }

    // 🔹 Display all brands
    public function index() {
        $result = $this->brand->getAll();
        require __DIR__ . '/../views/brand/display.php';
    }

    // 🔹 Show create form
    public function create() {
        require __DIR__ . '/../views/brand/create.php';
    }

    // 🔹 Store new brand
    public function store() {
        $name = $_POST['name'];
        // Handle image upload
        $img = $_FILES['img']['name'] ?? '';
        $tmp = $_FILES['img']['tmp_name'] ?? '';
        $imageNames = [];

        if (!empty($img)) {
            foreach ($img as $index => $image) {
                $newName = time() . '_' . basename($image);
                move_uploaded_file(
                    $tmp[$index],
                    __DIR__ . '/../public/img/' . $newName
                );
                $imageNames[] = $newName;
            }
        }

        $this->brand->create($name, implode(',', $imageNames));
        header('Location: /laptofy_MVC/brand/index.php');
        exit();
    }

    // 🔹 Show update form
    public function update() {
        $id = $_GET['id'];
        $brand = $this->brand->getById($id);
        require __DIR__ . '/../views/brand/update.php';
    }

    // 🔹 Update existing brand
    public function edit() {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // Handle image upload
        $img = $_FILES['img']['name'] ?? '';
        $tmp = $_FILES['img']['tmp_name'] ?? '';
        $imageNames = [];

        if (!empty($img)) {
            foreach ($img as $index => $image) {
                $newName = time() . '_' . basename($image);
                move_uploaded_file(
                    $tmp[$index],
                    __DIR__ . '/../public/img/' . $newName
                );
                $imageNames[] = $newName;
            }
        }

        // If no new images uploaded, keep existing images
        if (empty($imageNames)) {
            // Get existing image names from database for this brand
            $existingBrand = $this->brand->getById($id);
            if (!empty($existingBrand['img'])) {
                $imageNames = explode(',', trim($existingBrand['img']));
            }
        }

        // Update the brand with new or existing image names
        $this->brand->update($id, $name, implode(',', array_unique($imageNames)));
        
        header('Location: /laptofy_MVC/brand/index.php');
        exit();
    }

    // 🔹 Delete a brand
    public function delete() {
        if (isset($_GET['id'])) {
            // Delete associated images from the filesystem before deleting the brand record
            if ($brand = $this->brand->getById($_GET['id'])) {
                if (!empty($brand['img'])) {
                    foreach (explode(',', trim($brand['img'])) as $imageName) {
                        unlink(__DIR__ . '/../public/img/' . trim($imageName));
                    }
                }
            }
            
            // Delete the brand record from the database
            if ($this->brand->delete($_GET['id'])) {
                header('Location: /laptofy_MVC/brand/index');
                exit();
            } else {
                echo "Error deleting brand.";
            }
        } else {
            echo "Invalid request.";
        }
    }
}
