<?php
namespace app\common\model;
use think\Model;    //  导入think\Model类
/**
 * Project 项目表
 */
  
class Project extends Model
{
    public function Users()
    {
        return $this->belongsToMany('User',  config('database.prefix') . 'project_user');
    }
}