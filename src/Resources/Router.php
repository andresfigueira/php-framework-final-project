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
        $this->request = RouteHelper::parseRequest($_SERVER['REQUEST_URI']);
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->generateRoutes();
    }

    public function generateRoutes()
    {
        foreach (ROUTES as $route) {
            $url = $route['url'];
            $methods = $route['methods'];
            $controller = $route['controller'];
            $action = $route['action'];

            // TODO: 
            // Catch if class or method not found
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

    public function addRoute(string $uri, string $method, \Closure $fn): void
    {
        $this->routes[$uri][$method] = $fn;
    }

    public function hasRoute(string $uri): bool
    {
        // TODO:
        // Add method as key
        return array_key_exists($uri, $this->routes);
    }

    public function run()
    {
        if ($this->hasRoute($this->request)) {
            $this->routes[$this->request][$this->method]->call($this);
        }
    }
}
