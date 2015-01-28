<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('/phpinfo',function(){
	phpinfo();
});
Route::get('install/index','InstallIndexController@index');
Route::get('install/init','InstallIndexController@init');

require_once('demo_route.php');
require_once('index_route.php');
require_once('admin_route.php');
