<?php

namespace Core;

use Core\Helpers\RouteHelper;

require_once(ROOT . '/config/routes.php');

class Router
{
    private $request;
    private $method;

    public function __construct()
    {
        $url = $this->currentUrl();
        $this->request = RouteHelper::parseRequest($url);
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->generateRoutes();
    }

    public function run(): void
    {
        if ($this->hasRoute($this->request, $this->method)) {
            $this->routes[$this->request][$this->method]->call($this);
        } else {
            new Redirect('/404');
        }
    }

    public static function currentUrl()
    {
        if (array_key_exists('PATH_INFO', $_SERVER)) {
            return $_SERVER['PATH_INFO'];
        }

        return '/';
    }

    public function generateRoutes(): void
    {
        foreach (ROUTES as $route) {
            $url = $route['url'];
            $methods = $route['methods'];
            $controller = $route['controller'];
            $action = $route['action'];

            // TODO: 
            // Catch if controller or action not found
            foreach ($methods as $method) {
                $callback = function () use ($controller, $action) {
                    $useClass = "\\Controllers\\" . ucfirst($controller) . "Controller";

                    $class = new $useClass;

                    $class->{$action}();
                };

                $this->addRoute($url, $method, $callback);
            }
        }
    }

    public function addRoute(string $url, string $method, \Closure $fn): void
    {
        $this->routes[$url][$method] = $fn;
    }

    public function hasRoute(string $url, string $method): bool
    {
        return array_key_exists($url, $this->routes)
            and array_key_exists($method, $this->routes[$url]);
    }
}
