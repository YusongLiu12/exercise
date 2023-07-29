<?php
namespace app\common\validate;
use think\Validate;     // 内置验证类

class Project extends Validate
{
    protected $rule = [
        'project_name' => 'require|length:4,25',
    ];

    protected $message  = [
        'project_name.require' => '项目名称不能为空',  
        'project_name.length' => '项目名必须为4到25个字符',  
    ];
}