<?php

require_once __DIR__ . '/../models/Person.php';
require_once __DIR__ . '/../core/Person.php'; 

class PersonController
{

    public function registerView(): void
    {
        require __DIR__ . '/../views/user/registation.php';
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/public/person-register");
            exit();
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm_password'] ?? '');

        if (empty($fullname) || empty($email) || empty($password) || empty($confirm)) {
            echo "<script>
                    alert('All fields are required');
                    window.location='/laptofy_MVC/public/person-register';
                  </script>";
            exit();
        }

        if ($password !== $confirm) {
            echo "<script>
                    alert('Passwords do not match');
                    window.location='/laptofy_MVC/public/person-register';
                  </script>";
            exit();
        }

        $personModel = new PersonModel(); 

        if ($personModel->emailExists($email)) {
            echo "<script>
                    alert('Email already registered');
                    window.location='/laptofy_MVC/public/person-register';
                  </script>";
            exit();
        }

        $hashed  = password_hash($password, PASSWORD_DEFAULT);
        $success = $personModel->register($fullname, $email, $hashed);

        if ($success) {
            echo "<script>
                    alert('Registration successful! Please login.');
                    window.location='/laptofy_MVC/public/person-login';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Registration failed. Try again.');
                    window.location='/laptofy_MVC/public/person-register';
                  </script>";
            exit();
        }
    }

    public function loginView(): void
    {
        require __DIR__ . '/../views/user/login.php';
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /laptofy_MVC/public/person-login");
            exit();
        }

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            echo "<script>
                    alert('Email and Password required');
                    window.location='/laptofy_MVC/public/person-login';
                  </script>";
            exit();
        }

        $personModel = new PersonModel(); 
        $person = $personModel->findByEmail($email);

        if ($person && password_verify($password, $person['password'])) {
            Person::login($person); 
            header("Location: /laptofy_MVC/public/Home");
            exit();
        } else {
            echo "<script>
                    alert('Invalid email or password');
                    window.location='/laptofy_MVC/public/person-login';
                  </script>";
            exit();
        }
    }

    public function logout(): void
    {
        Person::logout();
        header("Location: /localhost/laptofy_MVC/public/home");
        exit(); 
    }
}
