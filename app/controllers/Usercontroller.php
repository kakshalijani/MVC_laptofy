<?php

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private User $userModel;

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

    // Show Profile Page
    public function profile(): void
    {
        $userId = intval($_SESSION['user']['id'] ?? 0);

        if (!$userId) {
            die("Invalid user session");
        }

        $user = $this->userModel->getUserById($userId);

        if (!$user) {
            die("User not found");
        }

        require __DIR__ . '/../views/user/profile.php';
    }

    // Update Profile
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/profile");
            exit;
        }

        $userId = intval($_SESSION['user']['id'] ?? 0);

        if (!$userId) {
            die("Invalid session");
        }

        $firstName = trim($_POST['first_name'] ?? '');
        $lastName  = trim($_POST['last_name'] ?? '');

        if (empty($firstName) || empty($lastName)) {
            die("First name and last name are required");
        }

        $profilePic = $_SESSION['user']['profile_pic'] ?? 'default.jpg';

        // Image Upload
        if (!empty($_FILES['profile_pic']['name'])) {

            $allowed = ['jpg','jpeg','png','webp'];
            $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                die("Invalid image format");
            }

            $uploadDir = __DIR__ . '/../../public/img/user/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = uniqid('user_', true) . '.' . $ext;
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath)) {

                // Delete old image
                if ($profilePic !== 'default.jpg') {

                    $oldFile = $uploadDir . $profilePic;

                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $profilePic = $fileName;
            }
        }

        // Update Database
        $data = [
            'id' => $userId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'profile_pic' => $profilePic
        ];

        if ($this->userModel->updateUserProfile($data)) {

            // Update session
            $_SESSION['user']['first_name'] = $firstName;
            $_SESSION['user']['last_name'] = $lastName;
            $_SESSION['user']['profile_pic'] = $profilePic;

            header("Location: /laptofy_MVC/profile?success=1");
            exit;
        }

        die("Profile update failed");
    }
}