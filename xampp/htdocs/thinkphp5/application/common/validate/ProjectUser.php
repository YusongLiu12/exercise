<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class ProjectUser extends Validate
{
    protected $rule = [
        'project_id' => 'int:0,1',
        'user_id'  => 'int:0,1',
    ];
}