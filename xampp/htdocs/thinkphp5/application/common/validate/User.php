<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class User extends Validate
{
    protected $rule = [
        'username' => 'require|length:2,25',
        'name' => 'require|length:2,25',
        'password'  => 'require|number|between:10,99999999',
    ];

    protected $message  =   [
        'username.length' => '用户名必须为2到25个字符',
        'username.require' => '用户名不能为空',
        'name.length'     => '姓名必须为2到25个字符', 
        'name.require' => '姓名不能为空',
        'password.number' => '密码必须为2-8位数字',
        'password.between' => '密码必须为2-8位数字',
    ];
}