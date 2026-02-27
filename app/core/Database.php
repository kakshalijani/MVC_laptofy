<?php
class Database {

    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "laptofy";

    public function connect() {
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

        if (!$conn) {
            die("Database Connection Failed");
        }

        return $conn;
    }
}