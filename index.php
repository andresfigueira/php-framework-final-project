<?php

declare(strict_types=1);

use Core\App;

use function Core\dd;

defined("ROOT")
    or define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require(ROOT . '/config/global.php');
require(ROOT . '/src/Core/autoload.php');
require(ROOT . '/src/Core/functions.php');

try {
    $app = new App();
    $app->run();
} catch (\Throwable $th) {
    dd($th);
}
