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

    // 🔹 Get user by email (for login)
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

    // 🔹 Get user by ID (for profile page)
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

    // 🔹 Update user profile
   public function updateUser($id,$first_name,$last_name,$email,$password,$profile)
{
    $sql = "UPDATE user 
            SET first_name='$first_name',
                last_name='$last_name',
                email='$email',
                password='$password',
                profile='$profile'
            WHERE id='$id'";

    return mysqli_query($this->conn,$sql);
}
}