<?php
/**
 * hualian工程
 *
 * DemoGuzzleController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/25 15:50
 */

class DemoGuzzleController extends BaseController{
	public function index(){
		$client = new GuzzleHttp\Client();
		$res = $client->get( 'www.baidu.com' );
		return $res->getBody();
	}

} 