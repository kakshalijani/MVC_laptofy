<?php
class Router
{
    public function route()
    {
        // Start session if not already
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Controller and action from query params set by .htaccess
        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action     = $_GET['action'] ?? DEFAULT_ACTION;

        // Sanitize for safety
        $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
        $action     = preg_replace('/[^a-zA-Z0-9]/', '', $action);

        // Build controller class name
        $controllerClass = ucfirst($controller) . 'Controller';
        $controllerFile  = __DIR__ . '/../controllers/' . $controllerClass . '.php';

        if (!file_exists($controllerFile)) {
            die("Controller file not found: " . $controllerClass);
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            die("Controller class not found: " . $controllerClass);
        }

        $controllerObject = new $controllerClass();

        if (!method_exists($controllerObject, $action)) {
            die("Action not found: " . $action);
        }

        // Call the action method
        $controllerObject->$action();
    }
}