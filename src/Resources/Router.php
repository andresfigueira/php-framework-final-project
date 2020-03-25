<?php

namespace Resources;

use Resources\Helpers\RouteHelper;

require_once(ROOT . '/config/routes.php');

class Router
{
    private $request;
    private $method;

    public function __construct()
    {
        $this->request = RouteHelper::parseRequest($_SERVER['PATH_INFO'] or $_SERVER['REQUEST_URI']);
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->generateRoutes();
    }

    public function generateRoutes(): void
    {
        foreach (ROUTES as $route) {
            $url = $route['url'];
            $methods = $route['methods'];
            $controller = $route['controller'];
            $action = $route['action'];
            $parameters = array_key_exists('parameters', $route) ? $route['parameters'] : [];

            // TODO: 
            // Catch if class or method not found
            foreach ($methods as $method) {
                $callback = function () use ($controller, $action) {
                    $useClass = "\\Controllers\\" . ucfirst($controller) . "Controller";

                    $class = new $useClass;

                    $class->{$action}();
                };

                $this->addRoute($url, $method, $parameters, $callback);
            }
        }
    }

    public function addRoute(string $url, string $method, array $parameters, \Closure $fn): void
    {
        $this->routes[$url][$method] = [
            'function' => $fn,
            'parameters' => $parameters,
        ];
    }

    public function hasRoute(string $url, string $method): bool
    {
        return array_key_exists($url, $this->routes)
            and array_key_exists($method, $this->routes[$url]);
    }

    public function run(): void
    {
        if ($this->hasRoute($this->request, $this->method)) {
            $this->routes[$this->request][$this->method]['function']->call($this);
        } else {
            // TODO:
            // Add 404 error page
            var_dump('404');
        }
    }
}
