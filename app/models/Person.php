<?php

require_once __DIR__ . '/../core/Database.php';

class PersonModel  
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

    
    public function register($fullname, $email, $password)
    {
        $sql = "INSERT INTO person (fullname, email, password) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("sss", $fullname, $email, $password);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    
    public function emailExists($email)
    {
        $sql = "SELECT id FROM person WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
        return $exists;
    }

    
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM person WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $person = $result->fetch_assoc();
        $stmt->close();
        return $person;
    }

    
    public function getPersonById($id)
    {
        $sql = "SELECT * FROM person WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $person = $result->fetch_assoc();
        $stmt->close();
        return $person;
    }

    
    public function updatePerson($id, $fullname, $email, $password)
    {
        $sql = "UPDATE person 
                SET fullname = ?, email = ?, password = ?
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if(!$stmt) die("Prepare failed: " . $this->conn->error);
        $stmt->bind_param("sssi", $fullname, $email, $password, $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}