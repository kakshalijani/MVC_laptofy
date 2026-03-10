<?php
require_once __DIR__ . '/Auth.php';

class Router
{
    public function route()
    {
        // Start session if not already
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Get controller & action from query params
        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action     = $_GET['action'] ?? DEFAULT_ACTION;

        // Sanitize
        $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
        $action     = preg_replace('/[^a-zA-Z0-9]/', '', $action);

        $controllerClass = ucfirst($controller) . 'Controller';
        $controllerFile  = __DIR__ . '/../controllers/' . $controllerClass . '.php';

        if (!file_exists($controllerFile)) {
            die("Controller file not found: " . $controllerClass);
        }

        require_once $controllerFile;

        if (!class_exists($controllerClass)) {
            die("Controller class not found: " . $controllerClass);
        }

        // Instantiate controller
        $controllerObject = new $controllerClass();

        // Safety net: protect admin pages
        $protectedControllers = ['DashboardController', 'ProductController', 'BrandController', 'UserController', 'ProfileController'];
        if (in_array($controllerClass, $protectedControllers)) {
            Auth::requireLogin();
        }

        // Call action
        if (!method_exists($controllerObject, $action)) {
            die("Action not found: " . $action);
        }

        $controllerObject->$action();
    }
}