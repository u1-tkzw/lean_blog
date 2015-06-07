<?php

/*
  |--------------------------------------------------------------------------
  | アプリケーションのルート
  |--------------------------------------------------------------------------
  |
  | ここでアプリケーションのルートを全て登録することが可能です。
  | 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
  | されたときに呼び出されるコントローラーを指定してください。
  |
 */

//Route::get('/', 'WelcomeController@index');
//Route::get('home', 'HomeController@index');

Route::get('home', 'User\UserController@getIndex');

Route::controllers([
    'auth'           => 'Auth\AuthController',
    'password'       => 'Auth\PasswordController',
    'post'           => 'Post\PostController',
    'api/blog'       => 'Post\PostApiController',
    'user'           => 'User\UserController',
    '/'              => 'User\UserController',
]);
