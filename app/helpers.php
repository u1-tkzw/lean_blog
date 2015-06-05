<?php

/**
 * スクリプトファイル(郡)を読み込んで script タグを出力する
 * 
 * @param type $scripts
 * @return HTML タグ
 */
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
