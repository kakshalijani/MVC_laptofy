<?php

require_once __DIR__ . '/../models/User.php';


class ProfileController
{

    public function __construct()
    {
        Auth::requireLogin();
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

        $first_name = $_POST['first_name'] ?? '';
        $last_name  = $_POST['last_name'] ?? '';
        $email      = $_POST['email'] ?? '';

        $old_password = $_POST['old_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';

        $user = $userModel->getUserById($id);

        $password = $user['password']; // keep old password

        if(!empty($old_password) && !empty($new_password)){

            if(!password_verify($old_password,$user['password'])){
                echo "<script>alert('Old password is incorrect');
                window.history.back();</script>";
                exit;
            }

            $password = password_hash($new_password, PASSWORD_DEFAULT);
        }

        $profile = $_SESSION['user']['profile'];

        if(isset($_FILES['profile']) && $_FILES['profile']['name'] != "")
        {
            $fileName = time() . "_" . $_FILES['profile']['name'];

            $uploadPath = __DIR__ . "/../../public/uploads/" . $fileName;
            move_uploaded_file($_FILES['profile']['tmp_name'], $uploadPath);

            $profile = $fileName;
        }

        $userModel->updateUser($id,$first_name,$last_name,$email,$password,$profile);

        // Update Session
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name']  = $last_name;
        $_SESSION['user']['email']      = $email;
        $_SESSION['user']['profile']    = $profile;

        header("Location: /laptofy_MVC/dashboard");
        exit;
    }
}