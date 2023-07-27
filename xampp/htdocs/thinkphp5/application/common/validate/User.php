<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class User extends Validate
{
    protected $rule = [
        'username' => 'require|length:4,25',
        'name' => 'require|length:4,25',
        'access_level'  => 'int',
        'password'  => 'int',
    ];
}