<?php
/**
 * hualian工程
 *
 * DemoPHPFunController.php文件
 *
 * User: Administrator
 * DateTime: 2014/12/31 13:28
 */

class DemoPHPFunController extends BaseController{
    public function start(){
        $key = Input::get('key');
        if('emaster' !== $key){
            return;
        }
        ignore_user_abort(true);
        set_time_limit(0);
        $GLOBALS['hpFlag'] = true;
        do{
            log::info('php定时任务');
            sleep(10);
            if(false ==  $GLOBALS['hpFlag']) {
                break;
            }
        }while(true);
    }

    public function stop(){
        $GLOBALS['hpFlag'] = false;
        echo "stop at " . date('Y年m月d日 h:i:s',time());
    }

    public function server(){
        if( !isset($_SERVER['HP_NUM']) ){
            $_SERVER['HP_NUM'] = 1;
        }else{
            $_SERVER['HP_NUM'] += 1;
        }
        echo $_SERVER['HP_NUM'];
    }

    public function slashes(){
        $str = 'a"b';
        echo $str;
        echo PHP_EOL;
        var_dump( get_magic_quotes_gpc() );
        echo PHP_EOL;
        echo get_magic_quotes_gpc();
        echo PHP_EOL;

        echo addslashes($str);
        echo PHP_EOL;
        echo addslashes($str);
    }
} 