<?php
/**
 * hualian工程
 *
 * IndexController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/10 14:38
 */

class DemoIndexController extends BaseController{
	public function index(){
		return View::make('home.index',array('mes' => '登录成功！'));
	}

	public function csrfCheck(){
//		var_dump(Input::all());
		$data = [1,2,3,4,];
		return $data;
//		return Input::all();
	}

}