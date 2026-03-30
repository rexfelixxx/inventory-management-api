<?php

require_once 'controllers/DefaultController.php';
class Router
{
    private static $routes = [];

    private static $default = [];

    public function __construct() {}

    public static function add($path, $method, $controller)
    {
        if (isset(self::$routes[$path][$method])) {
            throw new Exception('Route already exists');
        }
        self::$routes[$path][$method] = $controller;
    }

    public static function addDefault($controller = [DefaultController::class, 'notFound'])
    {
        self::$default = $controller;
    }

    public static function run()
    {
        $controller = self::$routes[$_SERVER['REQUEST_URI']][$_SERVER['REQUEST_METHOD']] ?? null;
        if (empty($controller)) {
            $controller = self::$default;
        }
        call_user_func($controller);
    }
}
