<?php
/**
 * hualian工程
 *
 * DemoRegController.php文件
 *
 * User: Administrator
 * DateTime: 2015-02-12 13:14
 */

class DemoRegController extends BaseController{
    public function index(){
        $strContent = 'HT@63691>150212001|SP=3/1&63693>150212003|SP=3/0@1*1@1';
        var_dump($strContent);
        $returnData = array( 'matchContent' => '', 'companyContent' => '' );
        $returnData['matchContent'] = mb_ereg_replace('>\d+','',$strContent);
        $returnData['companyContent'] = mb_ereg_replace('\d+>','',$strContent);
        var_dump($returnData);
    }

} 