<?php
/**
 * hualian工程
 *
 * DemoMd5Controller.php文件
 *
 * User: Administrator
 * DateTime: 2015/1/21 16:36
 */

class DemoMd5Controller extends BaseController{
    public function index(){
        $key = 'admin';
        echo md5($key);
//        echo hash_hmac('md5','000000','97d2dcb2ea177246d44f1114e2d5e9c5');
        echo '<br>';

        echo self::HmacMd5('000000','321');

        echo '<br>';
        echo hash_hmac('md5','000000','321');
    }
    public function HmacMd5($data,$key)
    {
        //需要配置环境支持iconv，否则中文参数不能正常处理
        $key = iconv("GB2312","UTF-8",$key);
        $data = iconv("GB2312","UTF-8",$data);

        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*",md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad ;
        $k_opad = $key ^ $opad;
        return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }
} 