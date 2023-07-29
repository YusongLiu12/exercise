<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class ProjectUser extends Validate
{
    protected $rule = [
        'project_id' => 'int',
        'user_id'  => 'int',
    ];

    protected $message = [
        'project_id.int' => '项目id必须为整数',
        'user_id.int' => '用户id必须为整数',
    ];
}