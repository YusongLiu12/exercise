<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class User extends Validate
{
    protected $rule = [
        'username' => 'require|length:4,25',
        'name' => 'require|length:4,25',
        'password'  => 'require|number|between:10,1000000',
    ];

    protected $message  =   [
        'username.length' => '用户名必须为4到25个字符',
        'username.require' => '用户名不能为空',
        'name.length'     => '姓名必须为4到25个字符', 
        'name.require' => '姓名不能为空',
        'password.require' => '密码不能为空',
    ];
}