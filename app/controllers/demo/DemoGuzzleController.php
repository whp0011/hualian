<?php
/**
 * hualian工程
 *http://docs.guzzlephp.org/en/latest/
 * DemoGuzzleController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/25 15:50
 */

class DemoGuzzleController extends BaseController{
    /**
     *
     * @return mixed
     * demo/guzzle/index
     */
	public function index(){
		$client = new GuzzleHttp\Client();
		$res = $client->get( 'www.baidu.com' );
		return $res->getBody();
	}

} 