<?php
namespace app\common\model;
use think\Model;    //  导入think\Model类
/**
 * Task 任务表
 */
  
class Task extends Model
{
    public function getStatusString($status)
    {
        $Task = new Task;
        if ($status === 0)
            $status_string = '未开始';
        elseif ($status === 1)
            $status_string = '进行中';
        elseif ($status === 2)
            $status_string = '已结束';
        return $status_string;
    }
}