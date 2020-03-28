<?php

defined('DATABASE_CONFIG')
    or define(
        'DATABASE_CONFIG',
        [
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
        ]
    );
