<?php

require_once __DIR__ . '/../core/Database.php';

class User
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

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        return $user;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        return $user;
    }

   public function updateUser($id, $first_name, $last_name, $email, $password, $profile)
{
    // Use placeholders instead of injecting variables
    $sql = "UPDATE user 
            SET first_name=?, last_name=?, email=?, password=?, profile=?
            WHERE id=?";

    $stmt = $this->conn->prepare($sql);

    if(!$stmt){
        die("Prepare failed: ".$this->conn->error);
    }

    // Bind parameters (s = string, i = integer)
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $password, $profile, $id);

    // Execute statement
    $success = $stmt->execute();

    $stmt->close();

    return $success;
}
}