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

    public function getAll()
    {
        $sql = "SELECT p.*, b.name AS brand_name
                FROM laptofy p
                LEFT JOIN brand b ON p.brand_id = b.brand_id
                ORDER BY p.id ASC";

        $stmt=$this->conn->prepare($sql);
        if(!$stmt){
            die("Prepare Failed: ".$this->conn->error);
        }
        $stmt->execute();
        $result=$stmt->get_result();
        $stmt->close();
        return $result;    
    }
    public function getTotalProducts()
    {
        $sql = "SELECT COUNT(*) as total FROM laptofy";
        $stmt=$this->conn->prepare($sql);
        if(!$stmt){
            die("Prepare Failed: ".$this->conn->error);
        }
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();
        $stmt->close();
        return $row['total'];
        
    }
    
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

        return $result->fetch_assoc(); 
    }

    public function insert($name, $description, $price, $status, $brand_id, $img)
    {
        $sql = "INSERT INTO laptofy (name, description, price, status, brand_id, img)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
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

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

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
    public function getByBrand($brand_id)
    {
        $sql = "SELECT p.*, b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE p.brand_id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $brand_id);
        $stmt->execute();

        return $stmt->get_result();
    }
    public function search($keyword)
    {
        $keyword = "%".$keyword."%";

        $sql = "SELECT p.*, b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE p.name LIKE ? 
            OR b.name LIKE ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare Failed: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $keyword, $keyword);

        $stmt->execute();

        return $stmt->get_result();
    }
    public function getActiveProducts()
    {
        $sql = "SELECT p.*, b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE p.status = 'active'
            ORDER BY p.id ASC";

        $result = $this->conn->query($sql);

        return $result;
    }
    public function filterProducts($keyword, $brand_id)
    {
        $sql = "SELECT p.*, b.name AS brand_name
            FROM laptofy p
            LEFT JOIN brand b ON p.brand_id = b.brand_id
            WHERE 1";

        if ($keyword != "") {
            $sql .= " AND p.name LIKE '%$keyword%'";
        }

        if ($brand_id != "") {
            $sql .= " AND p.brand_id = '$brand_id'";
        }

        $result = $this->conn->query($sql);

        return $result;
    }
    public function getProductsPaginated($limit,$offset)
    {
        $sql = "SELECT * FROM laptofy WHERE status=1 LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("ii",$limit,$offset);

        $stmt->execute();

        return $stmt->get_result();
    }
}