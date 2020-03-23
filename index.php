<?php

declare(strict_types=1);

use Resources\Router;

defined("ROOT")
    or define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require_once(ROOT . '/config/config.php');
require_once(ROOT . '/src/Resources/functions.php');
require_once(ROOT . '/config/autoload.php');

$app = new Router();
$app->run();
