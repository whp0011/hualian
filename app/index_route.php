<?php
/**
 * hualian工程
 *
 * index_route.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/10 14:40
 */
Route::get('/index/index','IndexController@index');
Route::get('/registe','IndexRegisteController@show');
Route::get('/user/login','IndexUserController@login');
Route::get('/user/auto_login','IndexUserController@autoLogin');