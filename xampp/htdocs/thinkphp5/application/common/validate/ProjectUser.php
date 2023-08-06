<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class ProjectUser extends Validate
{
    protected $rule = [
        'project_id' => 'number',
        'user_id'  => 'number',
    ];

    protected $message = [
        'project_id.number' => '项目id必须为整数',
        'user_id.number' => '用户id必须为整数',
    ];
}