<?php
require_once __DIR__ . '/../core/Database.php';

class Product
{
    private mysqli $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // 🔹 Get all products
    public function getAll(): mysqli_result
    {
         $sql = "
            SELECT 
                p.*,
                b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            ORDER BY p.id ASC
        ";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔹 Get product by ID
    public function getById(int $id): ?array
    {
        $sql = "
            SELECT 
                p.*,
                b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE p.id = ?
        ";       
         $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    // 🔹 Insert product
    public function insert(
        string $name,
        string $description,
        float $price,
        string $status,
        int $brand_id,
        string $img = ''
    ): bool {
        $sql = "INSERT INTO laptofy 
                (name, description, price, status, brand_id, img)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssdsis",
            $name,
            $description,
            $price,
            $status,
            $brand_id,
            $img
        );

        return $stmt->execute();
    }

    // 🔹 Check if product already exists
    public function productExists(string $name, ?int $excludeId = null): bool
    {
        if ($excludeId !== null) {
            $sql = "SELECT id FROM laptofy 
                    WHERE LOWER(name) = LOWER(?) AND id != ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("si", $name, $excludeId);
        } else {
            $sql = "SELECT id FROM laptofy WHERE LOWER(name) = LOWER(?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $name);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    public function getactiveproducts(): mysqli_result
    {
        $sql = "
            SELECT 
                p.*,
                b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE p.status = 'active'
            ORDER BY p.id ASC
        ";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }
    // 🔹 Update product
    public function update(
        int $id,
        string $name,
        string $description,
        float $price,
        string $status,
        string $img,
        int $brand_id
    ): bool {
        $sql = "UPDATE laptofy
                SET name = ?, description = ?, price = ?, status = ?, img = ?, brand_id = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssdssii",
            $name,
            $description,
            $price,
            $status,
            $img,
            $brand_id,
            $id
        );

        return $stmt->execute();
    }

    // 🔹 Delete product
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM laptofy WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}