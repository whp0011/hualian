<?php
/**
 * hualian工程
 *
 * DemoMathController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/16 13:28
 */

class DemoMathController extends BaseController{
	public function div(){
		var_dump($a = 20.0/76);
		var_dump($b = bcdiv(20,50,14));
		var_dump($a + $b);
	}

} 