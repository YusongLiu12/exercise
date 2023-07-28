<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class TaskEvent extends Validate
{
    protected $rule = [
        'task_event'  => 'require|length:4,25',
    ];

    protected $message  =   [
        'task_event.length' => '事件必须为4到25个字符',  
    ];
}