<?php
/**
 * hualian工程
 *
 * IndexController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/10 14:58
 */

class IndexController extends BaseController{

	public function index(){
		return View::make('home.index')->with(['mes' => 'msg']);
	}

} 