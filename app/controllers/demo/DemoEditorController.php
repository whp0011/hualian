<?php
/**
 * hualian工程
 *
 * DemoEditorController.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/22 14:07
 */

class DemoEditorController extends BaseController{
    public function show(){
        return View::make('demo.editor');
    }
} 