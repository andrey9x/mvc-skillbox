<?php


namespace Core\Http;


class Router
{
    protected static array $routes = [];

    public static function setRoutes(string $routesPath)
    {
        self::$routes = include $routesPath;
    }

    public static function dispatch(?Request $request)
    {
        if (self::$routes[$request->path()] ?? false) {
            echo 'route exists';
        } else {
            echo 'route not exists';
        }
    }
}