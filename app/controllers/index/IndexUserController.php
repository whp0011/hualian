<?php
/**
 * hualian工程
 *
 * IndexUserController.php文件
 *
 * User: Administrator
 * DateTime: 2015-01-27 16:26
 */

class IndexUserController extends BaseController{
    public function register(){

    }
    public function login(){
        $user = User::find(9);
        if (Hash::check('123456', $user->permissions))
        {
//            echo 'login';
        }else{
            echo 'false';
        }
        if (Auth::attempt(array('name' => 'whp0011', 'password' => '123456'),true))
        {
            Session::put('userId',$user->id);
//            return Redirect::to('/index/index');
//            return Redirect::intended('index/index');
            echo 'login success';
        }else{
            echo 'login fall!';
        }

        if (Auth::check())
        {
            echo 'has been login';
        }else{
            echo 'not login';
        }
        var_dump(Session::all());
    }

    public function autoLogin(){
        if (Auth::viaRemember())
        {
            var_dump(Session::all());
        }else{
            echo 'not login';
        }
    }
    public function logout(){

    }

} 