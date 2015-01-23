<?php
/**
 * hualian工程
 *
 * DemoASCIIController.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/23 13:14
 */

class DemoASCIIController extends BaseController{
    public function index(){
        for($i = 48;$i<=57;$i++){
            echo '\''. chr($i) .'\' => '. $i , ',<br>';
        }
        for($i = 65;$i<= 90;$i++){
            echo '\''. chr($i) .'\' => '. $i , ',<br>';
        }
        for($i = 97;$i<= 122;$i++){
            echo '\''. chr($i) .'\' => '. $i , ',<br>';
        }
    }

    public function ascii(){
        foreach(range('a','z') as $val){
            echo ord($val),'<br>';
        }
    }
} 