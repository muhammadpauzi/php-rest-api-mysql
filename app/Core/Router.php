<?php

namespace App\Core;

class Router
{
    public static array $routes = [];

    public static function get(string $path, array $handler = []): void
    {
        self::addRoute("GET", $path, $handler);
    }

    public static function post(string $path, array $handler = []): void
    {
        self::addRoute("POST", $path, $handler);
    }

    private static function addRoute(string $method, string $path, array $handler): void
    {
        self::$routes[] = [
            "method"        => $method,
            "path"          => $path,
            "controller"    => $handler[0],
            "function"      => $handler[1]
        ];
    }

    public static function run(): void
    {
        $path = '/';
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route['path'] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {
                $function = $route['function'];
                $controller = new $route['controller'];

                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        http_response_code(404);
    }
}
