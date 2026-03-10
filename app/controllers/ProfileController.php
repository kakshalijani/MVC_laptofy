<?php

require_once __DIR__ . '/../models/User.php';

class ProfileController
{

    public function __construct()
    {
        // Start session first
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if(!isset($_SESSION['user'])){
            header("location: /laptofy_mvc/login");
            exit();
        }

        $this->product = new Product();
    }
    public function edit()
    {
        $view = __DIR__ . '/../views/profile/edit.php';
        require __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        $userModel = new User();

        $id = $_SESSION['user']['id'];

        $first_name = $_POST['first_name']??'';
        $last_name = $_POST['last_name']??'';
        $email = $_POST['email']??'';
        $password = $_POST['password']??'';

        $profile = $_SESSION['user']['profile'];

        // Image Upload
        if(isset($_FILES['profile']) && $_FILES['profile']['name'] != "")
        {
            $fileName = time() . "_" . $_FILES['profile']['name'];

            $uploadPath = __DIR__ . "/../../public/uploads/" . $fileName;
            move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath);

            $profile = $fileName;
        }

        // Password Update
        if(!empty($password))
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        else
        {
            $password = $_SESSION['user']['password'];
        }

        $userModel->updateUser($id,$first_name,$last_name,$email,$password,$profile);

        // Update Session
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['profile'] = $profile;

        header("Location: /laptofy_MVC/dashboard");
        exit;
    }
}