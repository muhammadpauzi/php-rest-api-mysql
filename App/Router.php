<?php

namespace App;

class Router
{
    public static array $routes = [];

    public static function get(string $path, string $controller, string $function): void
    {
        self::$routes[] = [
            "method"        => "GET",
            "path"          => $path,
            "controller"    => $controller,
            "function"      => $function
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
                var_dump($variables);

                $function = $route['function'];
                $controller = new $route['controller'];

                array_shift($variables);
                var_dump($variables);
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        http_response_code(404);
    }
}
