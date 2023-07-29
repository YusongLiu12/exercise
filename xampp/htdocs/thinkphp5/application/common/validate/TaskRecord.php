<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class TaskRecord extends Validate
{
    protected $rule = [
        'status_edit_record'  => 'require|length:2,255',
    ];

    protected $message  =   [
        'status_edit_record.require' => '状态修改记录不能为空',  
        'status_edit_record.length' => '状态修改记录必须为2到255个字符',  
    ];
}