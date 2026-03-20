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
    public function profile(): void
{
    Person::requireLogin();

    $person_id   = $_SESSION['Person']['id'];
    $personModel = new PersonModel();
    $person      = $personModel->getPersonById($person_id);

    require __DIR__ . '/../views/user/person-profile.php';
}

public function updateProfile(): void
{
    Person::requireLogin();

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header("Location: /laptofy_MVC/public/person-profile");
        exit();
    }

    $person_id = $_SESSION['Person']['id'];
    $fullname  = trim($_POST['fullname'] ?? '');
    $email     = trim($_POST['email'] ?? '');

    if(empty($fullname) || empty($email)){
        echo "<script>
                alert('All fields are required');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }

    $personModel = new PersonModel();

    $existing = $personModel->findByEmail($email);
    if($existing && $existing['id'] != $person_id){
        echo "<script>
                alert('Email already taken by another account');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }

    $success = $personModel->updateProfile($person_id, $fullname, $email);

    if($success){
    $_SESSION['Person']['fullname'] = $fullname;
        $_SESSION['Person']['email']    = $email;

        echo "<script>
                alert('Profile updated successfully!');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Update failed. Try again.');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }
}

public function changePassword(): void
{
    Person::requireLogin();

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header("Location: /laptofy_MVC/public/person-profile");
        exit();
    }

    $person_id    = $_SESSION['Person']['id'];
    $old_password = trim($_POST['old_password'] ?? '');
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm      = trim($_POST['confirm_password'] ?? '');

    if(empty($old_password) || empty($new_password) || empty($confirm)){
        echo "<script>
                alert('All fields are required');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }

    if($new_password !== $confirm){
        echo "<script>
                alert('New passwords do not match');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }

    $personModel = new PersonModel();
    $person      = $personModel->getPersonById($person_id);

    if(!password_verify($old_password, $person['password'])){
        echo "<script>
                alert('Old password is incorrect');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }

    $hashed  = password_hash($new_password, PASSWORD_DEFAULT);
    $success = $personModel->updatePassword($person_id, $hashed);

    if($success){
        echo "<script>
                alert('Password changed successfully!');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Failed to change password. Try again.');
                window.location='/laptofy_MVC/public/person-profile';
              </script>";
        exit();
    }
}
}
