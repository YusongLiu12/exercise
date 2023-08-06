<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class User extends Validate
{
    protected $rule = [
        'username' => 'require|length:2,25',
        'name' => 'require|length:2,25',
        'password'  => 'require|numbersAndLetters:thinkphp|length:6,25',
    ];

    protected $message  =   [
        'username.length' => '用户名必须为2到25个字符',
        'username.require' => '用户名不能为空',
        'name.length'     => '姓名必须为2到25个字符', 
        'name.require' => '姓名不能为空',
        'password.require' => '密码不能为空',
        'password.numbersAndLetters' => '密码必须同时包含数字和字母',
        'password.length' => '密码必须为6-25位',
    ];

    protected function numbersAndLetters($value,$rule)
    {
        if (preg_match('/[A-Za-z]/', $value) && preg_match('/[0-9]/', $value))
        {
            return true;
        }
        return false;
    }
}