<?php
require_once __DIR__ . '/../core/Database.php';

class Brand {

    private mysqli $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();

        if (!$this->conn) {
            die("Database connection failed");
        }
    }

    // 🔹 Get all brands
    public function getAll(): mysqli_result {
        $sql = "SELECT * FROM brand ORDER BY brand_id ASC";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();
        return $stmt->get_result();
    }

    // 🔹 Get brand by ID
    public function getById(int $id): ?array {
        $sql = "SELECT * FROM brand WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc() ?: null;
    }

    // 🔹 Create new brand
    public function create(string $name, string $img): bool {
        $sql = "INSERT INTO brand (name, img) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $name, $img);
        return $stmt->execute();
    }

    // 🔹 Check if brand already exists (case-insensitive)
    public function brandExists(string $name, ?int $excludeId = null): bool {

        if ($excludeId !== null) {
            $sql = "SELECT brand_id FROM brand 
                    WHERE LOWER(name) = LOWER(?) AND brand_id != ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("si", $name, $excludeId);
        } else {
            $sql = "SELECT brand_id FROM brand WHERE LOWER(name) = LOWER(?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $name);
        }

        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    // 🔹 Update brand
    public function update(int $id, string $name, string $img): bool {
        $sql = "UPDATE brand SET name = ?, img = ? WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ssi", $name, $img, $id);
        return $stmt->execute();
    }

    // 🔹 Delete brand
    public function delete(int $id): bool {
        $sql = "DELETE FROM brand WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}