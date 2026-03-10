<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';

class AuthController
{

    // Show Login Page
    public function login(): void
    {
        require __DIR__ . '/../views/auth/login.php';
    }


    // Authenticate User
    public function authenticate(): void
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/login");
            exit();
        }

        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            echo "<script>
                    alert('Email and Password required');
                    window.location='/laptofy_MVC/login';
                  </script>";
            exit();
        }

        $userModel = new User();
        $user = $userModel->getUserByEmail($email);

        // Verify Password
        if ($user && password_verify($password, $user['password'])) {

            // Login Session
            Auth::login($user);

            // Redirect to Dashboard
                header("Location:/laptofy_MVC/dashboard");
                exit();
        } else {

            echo "<script>
                alert('Email and Password required');
                window.location='/laptofy_MVC/login';
                </script>";
                exit();
        }
    }


    // Logout
    public function logout(): void
    {

        Auth::logout();

        header("Location: /localhost/laptofy_MVC/login");
        exit();
    }
}