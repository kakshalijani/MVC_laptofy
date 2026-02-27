<?php
require_once __DIR__ . '/../core/Database.php';

class Brand {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Get all brands
    public function getAll() {
        $sql = "SELECT * FROM brand ORDER BY brand_id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function getById($id) {
        $sql = "SELECT * FROM brand WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function create($name, $img) {
        $sql = "INSERT INTO brand (name, img) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $name, $img);
        return $stmt->execute();
    }
    public function update($id, $name, $img) {
        $sql = "UPDATE brand SET name = ?, img = ? WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $img, $id);
        return $stmt->execute();
    }
    public function delete($id) {
        $sql = "DELETE FROM brand WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}