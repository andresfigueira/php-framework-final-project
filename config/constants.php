<?php

defined('TEMPLATES_PATH')
    or define('TEMPLATES_PATH', ROOT . '/src/templates');

defined('GLOBAL_CONFIG')
    or define(
        'GLOBAL_CONFIG',
        [
            'database' => DATABASE_CONFIG,
        ]
    );
