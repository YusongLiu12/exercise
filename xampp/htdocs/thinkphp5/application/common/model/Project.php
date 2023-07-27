<?php
namespace app\common\model;
use think\Model;    //  导入think\Model类
use think\Db;
/**
 * Project 项目表
 */
  
class Project extends Model
{
    public function Users()
    {
        return $this->belongsToMany('User',  config('database.prefix') . 'project_user');
    }

    public function getAccessTypeAttr($value)
    {
        $status = array('0'=>'公开','1'=>'私有', '2'=>'绝密');
        $access_string = $status[$value];
        if (isset($access_string))
        {
            return $access_string;
        } else {
            return $status[0];
        }
    }

    public function getMemberIds()
    {
        $project_id = $this->getData('id');
        //当前项目已加入的用户
        $ProjectUser_verify = new ProjectUser;
        $joined_users_array = array();
        $joined_users = $ProjectUser_verify->where('project_id', '=', $project_id)->select();
        foreach ($joined_users as $PUdata)
        {
            array_push($joined_users_array, $PUdata->getData('user_id'));
        }
        return $joined_users_array;
    }

    public function getMemberNames()
    {
        $project_id = $this->getData('id');
        //当前项目已加入的用户
        $ProjectUser_verify = new ProjectUser;
        $joined_users_array = array();
        $joined_users = $ProjectUser_verify->where('project_id', '=', $project_id)->select();
        foreach ($joined_users as $PUdata)
        {
            $user_id = $PUdata->getData('user_id');
            $User = User::get($user_id);
            array_push($joined_users_array, $User->getData('name'));
        }
        return $joined_users_array;
    }

    public function getOutsideUsers()
    {
        $project_id = $this->getData('id');
        $Project = Project::get($project_id);

        //未加入当前项目的用户
        $User_verify = new User;
        $inside_user_ids_array = $Project->getMemberIds();

        $outside_users = $User_verify->where('`id`', 'NOT IN', $inside_user_ids_array)->select();
        return $outside_users;
    }
}
