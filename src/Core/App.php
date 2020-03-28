<?php

namespace Core;

use Core\Router;

class App
{
    private String $env;
    private Router $router;

    public function __construct()
    {
        $this->init();
    }

    public function init(): void
    {
        $this->setEnv();
        $this->router = new Router();
    }

    public function run(): void
    {
        $this->router->run();
    }

    public function setEnv(?String $env = null)
    {
        $this->env = "development";

        if ($_SERVER['SERVER_NAME'] !== "localhost") {
            $this->env = "production";
        }

        return $env ? $env : $this->env;
    }

    public static function getEnv(): String
    {
        $app = new App();
        
        return $app->env;
    }
}
