<?php

class Controller
{
    public function __construct()
    {
        // Start session automatically
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // =========================
    // Load Model
    // =========================
    public function model(string $model)
    {
        $path = __DIR__ . '/../models/' . $model . '.php';

        if (!file_exists($path)) {
            die("Model file not found: " . $model);
        }

        require_once $path;

        if (!class_exists($model)) {
            die("Model class not found: " . $model);
        }

        return new $model();
    }

    // =========================
    // Load View
    // =========================
    public function view(string $view, array $data = [])
    {
        $path = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($path)) {
            die("View file not found: " . $view);
        }

        // Convert array keys into variables
        if (!empty($data)) {
            extract($data);
        }

        require_once $path;
    }
}