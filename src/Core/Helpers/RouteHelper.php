<?php

namespace Core\Helpers;

use function Core\dd;

class RouteHelper
{
    public static function parseRequest(string $request): string
    {
        $request = preg_replace("/(\/)\\1+/", "$1", $request);

        if ($request !== '/') {
            $request = rtrim($request, '/');
        }

        return $request;
    }
}
