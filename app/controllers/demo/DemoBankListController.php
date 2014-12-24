<?php
/**
 * hualian工程
 *
 * DemoBankListController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/24 14:07
 */

class DemoBankListController extends BaseController{
	public function index(){
		$bank = Bank::all();
		foreach($bank as $b){
			echo '\'' . $b->card_bin . '\' => \'' .$b->bank_name . '-' . $b->card_name . '-' . $b->card_type . '\',' .'<br>';
		}
	}

	public function bankInfo(){
//		$card = '6222021001116245702';
		$card = '6228481552887309119';
		$bankList = Config::get('bankList');
		$card_8 = substr($card,0,8);
		if ( isset( $bankList[$card_8] ) ) {
			echo $bankList[$card_8];
			return;
		}
		$card_6 = substr($card,0,6);
		if ( isset( $bankList[$card_6] ) ) {
			echo $bankList[$card_6];
			return;
		}
		$card_5 = substr($card,0,5);
		if ( isset( $bankList[$card_5] ) ) {
			echo $bankList[$card_5];
			return;
		}
		$card_4 = substr($card,0,4);
		if ( isset( $bankList[$card_4] ) ) {
			echo $bankList[$card_4];
			return;
		}
		echo '该卡号信息暂未录入';
	}
} 