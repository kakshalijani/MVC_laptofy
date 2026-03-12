<?php
require_once __DIR__ . '/Auth.php';

class Router
{
    public function route()
    {

        $controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
        $action     = $_GET['action'] ?? DEFAULT_ACTION;

        $controllerClass = $controller . 'Controller';
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

        $controllerObject->$action();
    }
    
}