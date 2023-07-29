<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class TaskEvent extends Validate
{
    protected $rule = [
        'task_event'  => 'require|length:2,255',
    ];

    protected $message  =   [
        'task_event.length' => '事件必须为2到255个字符',  
        'task_event.require' => '事件不能为空',  
    ];
}