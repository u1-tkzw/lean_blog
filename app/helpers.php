<?php

function scripts($scripts)
{
    if (! is_array($scripts)) {
        $scripts = [$scripts];
    }
    $result = [];
    foreach ($scripts as $script) {
        $result[] = Html::script($script);
    }
    return implode('', $result);
}
