<?php
class Person 
{
    private static function startSession(): void
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    public static function check(): bool
    {
        return isset($_SESSION['Person']);
    }

    public static function requireLogin(): void
    {
        if(!isset($_SESSION['Person'])){
            header("Location: /laptofy_MVC/public/person-login");
            exit();
        }
    }

    public static function login(array $person): void
    {
        $_SESSION['Person'] = [
            'id'       => $person['id'],
            'email'    => $person['email'],
            'fullname' => $person['fullname'] ?? '',
        ];
    }

    public static function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header("Location: /laptofy_MVC/public/home"); 
        exit();
    }
}