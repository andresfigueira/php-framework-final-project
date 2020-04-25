<?php

namespace Helpers;

class GeneralHelper {
    public static function emptyToNull($variable)
    {
        if (empty($variable)) {
            return null;
        }
        return $variable;
    }
}


