<?php

/**
 * File name: DemoDrawController.php
 * Desc:
 * Author: hp
 * E-mail: wanghaiping@lecai.com
 * Date Time: 2015/3/13 16:41
 */
class DemoDrawController extends BaseController
{
    public function index()
    {
        //建立一幅100*30的图像
        $image = imagecreatetruecolor(200, 100);

        //设置背景颜色
        $bgcolor = imagecolorallocate($image, 0, 0, 0);

        //设置字体颜色
        $textcolor = imagecolorallocate($image, 255, 255, 255);

        //把字符串写在图像左上角
        imagestring($image, 20, 15, 10, "Hello world!", $textcolor);

        //输出图像
        header("Content-type: image/jpeg");
        imagejpeg($image);
    }
}