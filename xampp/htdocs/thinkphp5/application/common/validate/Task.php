<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Task extends Validate
{
    protected $rule = [
        'task_title' => 'require|length:4,25',
        'leader_id'  => 'int',
        'status'  => 'int',
    ];
}