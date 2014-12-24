<?php
/**
 * hualian工程
 *
 * demo_route.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/10 14:39
 */
Route::get('demo/index','DemoIndexController@index');

Route::get('demo/csrf',function(){
	return View::make('demo.csrf');
});

Route::post( 'demo/csrfCheck',array('before' => 'csrf','uses' => 'DemoIndexController@csrfCheck') );
//Route::post('demo/csrfCheck',array('before' => 'csrf',function(){
//	return Input::all();
//}));

Route::get('demo/math/div','DemoMathController@div');

Route::get('demo/log/writelog','DemoLogController@writeLog');
Route::get('demo/log/sendmail','DemoLogController@sendMail');

//银行列表
Route::get('demo/bank','DemoBankListController@index');
Route::get('demo/bank/info','DemoBankListController@bankInfo');