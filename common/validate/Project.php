<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Project extends Validate
{
    protected $rule = [
        'project_name' => 'require|length:4,25',
        'access_type'  => 'in:0,1',
    ];
}