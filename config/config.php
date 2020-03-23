<?php

function getGlobalConfig()
{
    return [
        'database' => [
            'development' => [
                'database' => 'animal_care',
                'user' => 'root',
                'password' => 'root',
                'host' => 'localhost',
                'port' => 3306,
                'charset' => 'utf8'
            ],
            'production' => [
                'database' => '2BSJVbyCZ3',
                'user' => '2BSJVbyCZ3',
                'password' => 'A39XpLtXxY',
                'host' => 'remotemysql.com',
                'port' => 3306,
                'charset' => 'utf8'
            ]
        ],
        'urls' => [
            // 'baseUrl' => 'http://example.com'
        ],
        'paths' => [
            'resources' => '/path/to/resources',
            'images' => [
                'content' => ROOT . '/images/content',
                'layout' => ROOT . '/images/layout'
            ]
        ]
    ];
}

function getCurrentEnv()
{
    $env = "development";

    if ($_SERVER['SERVER_NAME'] !== "localhost") {
        $env = "production";
    }

    return $env;
}

// Constants
defined('GLOBAL_ENV')
    or define('GLOBAL_ENV', getCurrentEnv());

defined('GLOBAL_CONFIG')
    or define('GLOBAL_CONFIG', getGlobalConfig());

defined('TEMPLATES_PATH')
    or define('TEMPLATES_PATH', ROOT . '/src/templates');

// Error handling
ini_set('error_reporting', 'true');
error_reporting(E_ALL | E_STRICT);
