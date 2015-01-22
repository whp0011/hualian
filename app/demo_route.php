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

//laravel中的Request类
Route::get('demo/request/root','DemoRequestController@root');

//laravel中的Redirect类
Route::get('demo/redirect/index','DemoRedirectController@index');

//GuzzleHttp
Route::get('demo/guzzle/index','DemoGuzzleController@index');

//DB
Route::get('demo/db/index','DemoDBController@index');

//PHP内置函数
Route::get('demo/php/abort_start','DemoPHPFunController@start');
Route::get('demo/php/abort_stop','DemoPHPFunController@stop');
Route::get('demo/php/server','DemoPHPFunController@server');
Route::get('demo/php/slashes','DemoPHPFunController@slashes');

//PHPMAILER
Route::get('demo/mail/163','DemoMailController@mail163');

//File upload
Route::get('demo/view/fileupload',function(){
    return View::make('demo.file-upload');
});
Route::post('demo/file/upload','DemoFileController@upload');

//base64
Route::get('demo/base64/encode','DemoBase64Controller@doBase64');
Route::get('demo/base64/encode2','DemoBase64Controller@doBase64_2');
Route::get('demo/base64/decode','DemoBase64Controller@unBase64');
Route::get('demo/base64/decode2','DemoBase64Controller@unBase64_2');

//md5  hash_hmac
Route::get('demo/md5/index','DemoMd5Controller@index');

//editor富文本编辑器
Route::get('demo/editor/show','DemoEditorController@show');