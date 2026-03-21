<?php
require_once __DIR__ . '/../core/Database.php';

class Cart
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        if(!$this->conn) die("Database connection failed");
    }

    public function add($person_id, $product_id)
    {
        if($this->exists($person_id, $product_id)){
            return $this->increaseQuantity($person_id, $product_id);
        }

        $sql = "INSERT INTO cart (person_id, product_id, quantity) VALUES (?, ?, 1)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function remove($person_id, $product_id)
    {
        $sql = "DELETE FROM cart WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function exists($person_id, $product_id)
    {
        $sql = "SELECT id FROM cart WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    public function increaseQuantity($person_id, $product_id)
    {
        $sql = "UPDATE cart SET quantity = quantity + 1 WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function decreaseQuantity($person_id, $product_id)
    {
        $sql = "SELECT quantity FROM cart WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if($row && $row['quantity'] <= 1){
            return $this->remove($person_id, $product_id);
        }

        $sql = "UPDATE cart SET quantity = quantity - 1 WHERE person_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $person_id, $product_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function getByPerson($person_id)
    {
        $sql = "SELECT c.*, p.name, p.price, p.img, b.name AS brand_name,
                (c.quantity * p.price) AS subtotal
                FROM cart c
                JOIN laptofy p ON c.product_id = p.id
                LEFT JOIN brand b ON p.brand_id = b.brand_id
                WHERE c.person_id = ?
                ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        return $result;
    }

    public function getTotalPrice($person_id)
    {
        $sql = "SELECT SUM(c.quantity * p.price) AS total
                FROM cart c
                JOIN laptofy p ON c.product_id = p.id
                WHERE c.person_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] ?? 0;
    }

    public function getTotalItems($person_id)
    {
        $sql = "SELECT SUM(quantity) AS total FROM cart WHERE person_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $person_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['total'] ?? 0;
    }

    public function syncSessionToDb($person_id)
    {
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $product_id => $quantity){
                if($this->exists($person_id, $product_id)){
                    $sql = "UPDATE cart SET quantity = quantity + ? WHERE person_id = ? AND product_id = ?";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("iii", $quantity, $person_id, $product_id);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    $sql = "INSERT INTO cart (person_id, product_id, quantity) VALUES (?, ?, ?)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->bind_param("iii", $person_id, $product_id, $quantity);
                    $stmt->execute();
                    $stmt->close();
                }
            }
            $_SESSION['cart'] = [];
        }
    }
}