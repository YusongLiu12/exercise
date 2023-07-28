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

    public function getStatusAttr($value)
    {
        $status = array('0'=>'未开始','1'=>'进行中', '2'=>'已结束');
        $status_string = $status[$value];
        if (isset($status_string))
        {
            return $status_string;
        } else {
            return $status[0];
        }
    } 

    public function getRecords()
    {
        //获取任务状态修改记录
        $task_id = $this->getData('id');
        $TaskRecord = new TaskRecord;
        $TaskRecords = $TaskRecord->where('task_id', '=', $task_id)->order('id asc')->select();

        //获取字符串数组
        $TaskRecords_array = array();
        foreach($TaskRecords as $_task_record)
        {
            array_push($TaskRecords_array, $_task_record->getData('status_edit_record'));
        }

        if(!($TaskRecords_array))
        {
            array_push($TaskRecords_array, "该任务暂无状态记录");
        }

        return $TaskRecords_array;
    } 

    public function getEvents()
    {
        //获取任务状态修改记录
        $task_id = $this->getData('id');
        $TaskEvent = new TaskEvent;
        $TaskEvents = $TaskEvent->where('task_id', '=', $task_id)->order('id asc')->select();
        
        //获取字符串数组
        $TaskEvents_array = array();
        foreach($TaskEvents as $_task_event)
        {
            array_push($TaskEvents_array, $_task_event->getData('task_event'));
        }

        if(!($TaskEvents_array))
        {
            array_push($TaskEvents_array, "该任务暂无事件记录");
        }

        return $TaskEvents_array;
    } 

    public function getStartTimeAttr($value)
    {
        return date('Y年m月d日H时i分', strtotime($value));
    }

    public function getEndTimeAttr($value)
    {
        return date('Y年m月d日H时i分', strtotime($value));
    }
}