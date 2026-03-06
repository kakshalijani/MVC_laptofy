<?php

require_once __DIR__ . '/../core/Database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();

        if (!$this->conn) {
            die("Database connection failed");
        }
    }

    // 🔹 Get all products
    public function getAll()
    {
        $sql = "SELECT p.*, b.name AS brand_name
                FROM laptofy p
                LEFT JOIN brand b ON p.brand_id = b.brand_id
                ORDER BY p.id ASC";

        $result = $this->conn->query($sql);

        if (!$result) {
            die("Query Failed: " . $this->conn->error);
        }

        return $result;
    }
    public function getTotalProducts()
{
    $sql = "SELECT COUNT(*) AS total FROM laptofy";
    $result = mysqli_query($this->conn, $sql);

    $row = mysqli_fetch_assoc($result);

    return $row['total'];
}
    

    // 🔹 Get product by ID
    public function getById($id)
    {
        $sql = "SELECT p.*, b.name AS brand_name
                FROM laptofy p
                LEFT JOIN brand b ON p.brand_id = b.brand_id
                WHERE p.id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();

        return $result;
    }

    // 🔹 Insert product
    public function insert($name, $description, $price, $status, $brand_id, $img)
    {
        $sql = "INSERT INTO laptofy (name, description, price, status, brand_id, img)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssdsss",
            $name,
            $description,
            $price,
            $status,
            $brand_id,
            $img
        );

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    // 🔹 Check if product exists
    public function productExists($name)
    {
        $sql = "SELECT id FROM laptofy WHERE name = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();

        $exists = $result->num_rows > 0;

        $stmt->close();

        return $exists;
    }

    // 🔹 Update product
    public function update($id, $name, $description, $price, $status, $img, $brand_id)
    {
        $sql = "UPDATE laptofy 
                SET name = ?, description = ?, price = ?, status = ?, img = ?, brand_id = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
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

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    // 🔹 Delete product
    public function delete($id)
    {
        $sql = "DELETE FROM laptofy WHERE id = ?";

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