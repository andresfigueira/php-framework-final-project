<?php

namespace Resources\Helpers;

use function Resources\dd;

class RouteHelper
{
    public static function parseRequest(string $request): string
    {
        dd($request);
        $request = preg_replace("/(\/)\\1+/", "$1", $request);

        if ($request !== '/') {
            $request = rtrim($request, '/');
        }

        return $request;
    }
}
