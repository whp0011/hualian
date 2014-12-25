<?php
/**
 * hualian工程
 *
 * DemoRequestController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/24 15:47
 */

class DemoRequestController extends BaseController{
	public function root(){
		echo Request::getHttpHost();//localhost:9666
		echo Request::getUri();//http://localhost:9666/demo/request/root
		echo Request::getClientIp();//127.0.0.1
		echo Request::ip();
	}
} 