<?php
/**
 * hualian工程
 *
 * DemoDBController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/26 11:30
 */

class DemoDBController extends BaseController{
	public function index(){
		$bank = Bank::where('card_bin','=',621098)->count();
		var_dump($bank);
		if( $bank ) {
			echo '存在';
		}else{
			echo '不存在';
		}
	}

} 