<?php

require_once __DIR__ . '/../core/Database.php';

class Brand
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();

        if (!$this->conn) {
            die("Database connection failed");
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM brand ORDER BY brand_id ASC";
        $result = $this->conn->query($sql);

        if (!$result) {
            die("Query Failed: " . $this->conn->error);
        }

        return $result; 
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM brand WHERE brand_id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $brand = $result->fetch_assoc();

        $stmt->close();

        return $brand;
    }
    public function getTotalBrands()
    {
        $sql = "SELECT COUNT(*) as total FROM brand";
        $result = mysqli_query($this->conn,$sql);
        $row = mysqli_fetch_assoc($result);

        return $row['total'];
    }

    public function create($name, $img)
    {
        $sql = "INSERT INTO brand (name, img) VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $name, $img);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function brandExists($name, $excludeId = null)
    {
        if ($excludeId) {

            $sql = "SELECT brand_id FROM brand WHERE name = ? AND brand_id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $name, $excludeId);

        } else {

            $sql = "SELECT brand_id FROM brand WHERE name = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $name);
        }

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        $stmt->close();

        return $exists;
    }

    public function update($id, $name, $img)
    {
        $sql = "UPDATE brand SET name = ?, img = ? WHERE brand_id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("ssi", $name, $img, $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM brand WHERE brand_id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }
}