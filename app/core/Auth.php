<?php

class Auth
{
    private static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function check(): bool
    {
        self::startSession();
        return isset($_SESSION['user']);
    }

    public static function requireLogin(): void
    {
        //self::startSession();

        if (!isset($_SESSION['user'])) {
            header("Location: /laptofy_MVC/login");
            exit();
        }
    }

    public static function login(array $user): void
    {
        self::startSession();

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'] ?? '',
            'last_name' => $user['last_name'] ?? '',
            'profile_pic' => $user['profile_pic'] ?? 'default.jpg'
        ];
    }

    public static function logout(): void
    {
        //self::startSession();

        $_SESSION = [];

        session_destroy();

        header("Location: /laptofy_MVC/login");
        exit();
    }

    public static function user()
    {
        self::startSession();
        return $_SESSION['user'] ?? null;
    }
}