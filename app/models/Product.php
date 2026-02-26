<?php
require_once __DIR__ . '/../core/Database.php';

class Product
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM laptofy ORDER BY id ASC";
        return mysqli_query($this->conn, $sql);
    }

    public function getById($id)
    {
        $id = (int)$id;
        $sql = "SELECT * FROM laptofy WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function insert($name, $description, $price, $status, $img)
    {
        $name = mysqli_real_escape_string($this->conn, $name);
        $description = mysqli_real_escape_string($this->conn, $description);
        $status = mysqli_real_escape_string($this->conn, $status);
        $img = mysqli_real_escape_string($this->conn, $img);

        $sql = "INSERT INTO laptofy (name, description, price, status, img)
                VALUES ('$name', '$description', '$price', '$status', '$img')";

        return mysqli_query($this->conn, $sql);
    }

    public function update($id, $name, $description, $price, $status, $img)
    {
        $id = (int)$id;
        $name = mysqli_real_escape_string($this->conn, $name);
        $description = mysqli_real_escape_string($this->conn, $description);
        $status = mysqli_real_escape_string($this->conn, $status);
        $img = mysqli_real_escape_string($this->conn, $img);

        $sql = "UPDATE laptofy SET
                name='$name',
                description='$description',
                price='$price',
                status='$status',
                img='$img'
                WHERE id=$id";

        return mysqli_query($this->conn, $sql);
    }

    public function delete($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM laptofy WHERE id=$id";
        return mysqli_query($this->conn, $sql);
    }
}