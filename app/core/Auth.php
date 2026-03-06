<?php

class Auth
{
    // Start session automatically
    private static function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // =============================
    // Check if user is logged in
    // =============================
    public static function check(): bool
    {
        self::startSession();
        return isset($_SESSION['user']);
    }

    // =============================
    // Require login for protected pages
    // =============================
    public static function requireLogin(): void
    {
        self::startSession();

        if (!isset($_SESSION['user'])) {
            header("Location: /laptofy_MVC/public/index.php?controller=auth&action=login");
            exit();
        }
    }

    // =============================
    // Login user
    // =============================
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

    // =============================
    // Logout user
    // =============================
    public static function logout(): void
    {
        self::startSession();

        $_SESSION = [];

        session_destroy();

        header("Location: /laptofy_MVC/public/index.php?controller=auth&action=login");
        exit();
    }

    // =============================
    // Get logged-in user
    // =============================
    public static function user()
    {
        self::startSession();
        return $_SESSION['user'] ?? null;
    }
}