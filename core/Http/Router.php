<?php


namespace Core\Http;


use Exception;

class Router
{
    protected static array $routes = [];

    public static function setRoutes(string $routesPath)
    {
        self::$routes = include $routesPath;
    }

    public static function dispatch(?Request $request)
    {
         $handler = self::$routes[$request->path()] ?? null;

         if (is_null($handler)) {
             throw new Exception("404 not found");
         }

         return call_user_func_array($handler, []);
    }
}