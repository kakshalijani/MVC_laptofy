<?php

require_once __DIR__ . '/../core/Database.php';

class Wishlist
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();

        if(!$this->conn){
            die("Database connection failed");
        }
    }

    public function add($person_id, $product_id)
    {
        $sql = "INSERT INTO wishlist (person_id, product_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function remove($person_id, $product_id)
    {
        $sql = "DELETE FROM wishlist WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function exists($person_id, $product_id)
    {
        $sql = "SELECT id FROM wishlist WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("ii", $person_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function getByPerson($person_id)
    {
        $sql = "SELECT w.*, p.name, p.price, p.img, b.name AS brand_name
                FROM wishlist w
                JOIN laptofy p ON w.product_id = p.id
                LEFT JOIN brand b ON p.brand_id = b.brand_id
                WHERE w.person_id = ?
                ORDER BY w.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function countByPerson($person_id)
    {
        $sql = "SELECT COUNT(*) as total FROM wishlist WHERE person_id = ?";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'];
    }
}
