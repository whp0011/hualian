<?php
/**
 * hualian工程
 *
 * DemoRedisController.php文件
 *
 * User: Administrator
 * DateTime: 2015-01-28 10:33
 */

class DemoRedisController extends BaseController{
    public function index(){
        $redis = Redis::connection();
        $redis->set('name', 'Taylor');

        $name = $redis->get('name');
        var_dump($name);


//        Redis::set('name','whp');
//        $values = Redis::lrange('names', 5, 10);
//        var_dump($values);
//        $name = Redis::get('name');
//        var_dump($name);
//

//
//        Redis::pipeline(function($pipe)
//        {
//            for ($i = 0; $i < 10; $i++)
//            {
//                $pipe->set("key:$i", $i);
//            }
//        });
//
//        $minutes = 10;
//        $value = Cache::remember('users', $minutes, function()
//        {
//            return User::find(9);
//        });
////        var_dump($value);
//
//        $val = Cache::remember('whp',10,function(){
//            return 100;
//        });
//        var_dump($val);
//        var_dump(Cache::get('whp'));


//        $user = Cache::get('users');
//        var_dump($user);
    }


} 