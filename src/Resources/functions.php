<?php

namespace Resources;

function dd($var, $die = true)
{
    highlight_string("<?php\n\n" . var_export($var, true) . ";\n\n?>\n\n");

    if ($die) {
        die();
    }
}
