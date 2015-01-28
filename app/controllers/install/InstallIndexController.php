<?php
/**
 * hualian工程
 *
 * InstallIndexController.php文件
 *
 * User: Administrator
 * DateTime: 2015-01-27 14:47
 */

class InstallIndexController extends BaseController{
    public function index(){
        return View::make('install.index');
    }
    public function init(){
        $migrate = new CreateMoneysTable();
        $migrate->up();
    }

} 