<?php

class Router
{
    public function route()
    {
        // Start session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Get controller & action from URL
        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action     = $_GET['action'] ?? DEFAULT_ACTION;

        // Sanitize URL values
        $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
        $action     = preg_replace('/[^a-zA-Z0-9]/', '', $action);

        // Controller class name
        $controllerClass = ucfirst($controller) . 'Controller';

        // Controller file path
        $controllerFile = __DIR__ . '/../controllers/' . $controllerClass . '.php';

        // Check controller file
        if (!file_exists($controllerFile)) {
            die("Controller file not found: " . $controllerClass);
        }

        // Load controller
        require_once $controllerFile;

        // Check class exists
        if (!class_exists($controllerClass)) {
            die("Controller class not found: " . $controllerClass);
        }

        // Create controller object
        $controllerObject = new $controllerClass();

        // Check action exists
        if (!method_exists($controllerObject, $action)) {
            die("Action not found: " . $action);
        }

        // Call action
        $controllerObject->$action();
    }
}