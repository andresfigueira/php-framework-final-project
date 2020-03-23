<?php

function autoload($className)
{
    $file = ROOT. "\src\\" . $className . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoload');
