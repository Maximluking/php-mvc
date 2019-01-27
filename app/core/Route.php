<?php

namespace app\core;

class Route
{
    public static function start()
    {
        $controllerName = 'Tasks';
        $modelName = 'Tasks';
        $actionName = 'Index';

        $routes = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        if (!empty($routes[1])) {
            $controllerName = ucfirst($routes[1]);
            $modelName = ucfirst($routes[1]);
        }

        if (!empty($routes[2])) {
            $actionName = ucfirst($routes[2]);
        }

        $controllerName = $controllerName . 'Controller';
        $modelName = $modelName . 'Model';
        $actionName = 'action' . $actionName;

        $modelFile = $modelName . '.php';
        $modelPath = MODEL_PATH . $modelFile;
        if (file_exists($modelPath)) {
            require_once $modelPath;
        }

        $controllerFile = $controllerName . '.php';
        $controllerPath = CONTROLLER_PATH . $controllerFile;
        if (file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {
            self::ErrorPageGoDef();
        }

        $controllerName = '\\app\controllers\\' . $controllerName;

        $controller = new $controllerName();
        $action = $actionName;

        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            self::ErrorPageGoDef();
        }
    }

    public static function ErrorPageGoDef()
    {
        header("Location: /");
    }
}