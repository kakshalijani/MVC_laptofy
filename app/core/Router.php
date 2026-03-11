<?php
require_once __DIR__ . '/Auth.php';

class Router
{
    public function route()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action     = $_GET['action'] ?? DEFAULT_ACTION;

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

        $controllerObject = new $controllerClass();

        $protectedControllers = ['DashboardController', 'ProductController', 'BrandController', 'UserController', 'ProfileController'];
        if (in_array($controllerClass, $protectedControllers)) {
            Auth::requireLogin();
        }

        if (!method_exists($controllerObject, $action)) {
            die("Action not found: " . $action);
        }

        $controllerObject->$action();
    }
}