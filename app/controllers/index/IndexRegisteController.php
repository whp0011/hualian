<?php
/**
 * hualian工程
 *
 * IndexRegisteController.php文件
 *
 * User: Administrator
 * DateTime: 2015-01-27 15:57
 */

class IndexRegisteController extends BaseController{
    public function show(){
        $users['name'] = 'whp0011';
        $users['password'] =Hash::make('123456');
        $users['email'] = 'whp0011@163.com';
        $users['permissions'] =Hash::make('123456');
        $users['activated'] = '1';
        $users['activation_code'] = '';
        $users['activated_at'] = date('Y-m-d h:i:s',time());
        $users['last_login'] = date('Y-m-d h:i:s',time());
        $users['persist_code'] = '';
        $users['reset_password_code'] = '';
        $users['first_name'] = 'wang';
        $users['last_name'] = 'emaster';
        $users['activated_ip'] = Request::ip();
        $users['last_ip'] =  Request::ip();

        var_dump(User::create($users));

    }

} 