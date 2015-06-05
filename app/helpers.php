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

/**
 * ユーザ情報未登録時用のダミーデータを生成
 * 
 * @param type $user
 * @return object
 */
function getDummyUserObject($user)
{
    $dummy               = [];
    $dummy['blog_title'] = $user->name . 'のブログ';
    $dummy['comment']    = '未登録';
    $dummy['sex']        = '未登録';
    $dummy['birthday']   = '未登録';
    $dummy['image']      = 'images/default/default_icon.png';
    
    return (object)$dummy;
}