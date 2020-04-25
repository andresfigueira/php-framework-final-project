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

    public static function defaultBlankImage() {
        return 'https://748073e22e8db794416a-cc51ef6b37841580002827d4d94d19b6.ssl.cf3.rackcdn.com/not-found.png';
    }
}


