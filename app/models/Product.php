<?php
require_once __DIR__ . '/../core/Database.php';
class Product { 

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 🔹 Get All Products
    public function getAll() {
        $sql = "SELECT * FROM laptofy ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔹 Get Product By ID
    public function getById($id) {
        $sql = "SELECT * FROM laptofy WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id); // i = integer
        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔹 Insert Product
    public function insert($name, $description, $price, $status, $brand_id, $img = '') {
    // We REMOVE 'id' from here because the database will generate it automatically
    $sql = "INSERT INTO laptofy (name, description, price, status, img, brand_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    
    // "ssdssi" = string, string, double, string, string, integer
    $stmt->bind_param("ssdssi", $name, $description, $price, $status, $img, $brand_id);
    
    return $stmt->execute();
}

    // 🔹 Update Product
    public function update($id, $name, $description, $price, $status, $img, $brand_id) {
        $sql = "UPDATE laptofy 
                SET name = ?, description = ?, price = ?, status = ?, img = ?, brand_id = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdssii", $name, $description, $price, $status, $img, $brand_id, $id);
        return $stmt->execute();
    }

    // 🔹 Delete Product
    public function delete($id) {
        $sql = "DELETE FROM laptofy WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}