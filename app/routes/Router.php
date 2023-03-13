<?php

namespace App\routes;

use App\helpers\Request;
use App\helpers\Uri;
use Exception;

class Router
{
    const  CONTROLLER_NAMESPACE = "App\\controller";

    public static function load(string $controller, string $method, array $params = [])
    {
        try {
            $controllerNamespace = self::CONTROLLER_NAMESPACE . '\\' . $controller;

            if (!class_exists($controllerNamespace)) {
                throw new Exception("O Controlador {$controller} não existe");
            }

            if (!method_exists($controllerNamespace, $method)) {
                throw new Exception("O Método {$method} não existe");
            }

            $controllerInstance = new $controllerNamespace();

            $controllerInstance->$method((object) $_REQUEST, $params);
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public static function urlWithParams(string $requestUri, string $requestMethod, array $routes)
    {
        foreach ($routes[$requestMethod] as $uri => $action) {

            $pattern = preg_replace('/\{([^\}]+)\}/', '(?P<$1>[^/]+)', $uri);
            $pattern = str_replace('/', '\/', $pattern);

            if (preg_match('/^' . $pattern . '$/', $requestUri, $params)) {

                $vars = array();

                foreach ($params as $key => $value) {
                    if (is_string($key)) {
                        $vars[$key] = $value;
                    }
                }

                return  [
                    "action" => $action,
                    "params" => $vars
                ];
            }
        }

        return false;
    }

    public static function execute()
    {
        $uri = Uri::get("path");
        $routes = require 'routes.php';
        $requestMethod = Request::getMethod();

        try {

            if (!isset($routes[$requestMethod])) {
                throw new Exception("A rota não existe");
            }

            if ($uri !== "/") {
                $routesWithParameters = self::urlWithParams($uri, $requestMethod, $routes);
                if ($routesWithParameters) {
                    call_user_func_array($routesWithParameters['action'], $routesWithParameters['params']);
                    exit;
                };
            }

            if (!array_key_exists($uri, $routes[$requestMethod])) {
                throw new Exception('A rota não existe');
            }

            $router = $routes[$requestMethod][$uri];

            if (!is_callable($router)) {
                throw new Exception("Route {$uri} is not callable");
            }

            $router();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
