<?php

namespace Core;

function dd()
{
    echo "<div style='background-color: white;'>";
    highlight_string("<?php\n\n" . var_export(func_get_args(), true) . ";\n\n?>\n\n");
    echo "</div>";
}
