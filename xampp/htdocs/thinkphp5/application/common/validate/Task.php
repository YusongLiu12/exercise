<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Task extends Validate
{
    protected $rule = [
        'task_title' => 'require|length:2,25',
    ];

    protected $message  =   [
        'task_title.length' => '任务标题必须为2到25个字符',  
        'task_title.require' => '任务标题不能为空',  
    ];
}