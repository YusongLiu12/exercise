<?php
namespace app\common\model;
use think\Model;    //  导入think\Model类
/**
 * User 用户表
 */
  
class User extends Model
{
    /**
     * 验证密码是否正确
     * @param  string $password 密码
     * @return bool           
     */
    public function checkPassword($password)
    {
        if ($this->getData('password') === (int)$password)
        {
            return true;
        } else {
            return false;
        }
    }

    public function getAccessLevelAttr($value)
    {
        $status = array('0'=>'用户','1'=>'管理员', '2'=>'博士');
        $access_level = $status[$value];
        if (isset($access_level))
        {
            return $access_level;
        } else {
            return $status[0];
        }
    } 

    public function getNameById($id)
    {
        $User = self::get($id);
        if ($User === null)
        {
            var_dump($id);
            die();
        }
        return $User->getData('name');
    }

    public function getJoinedProjects()
    {
        $user_id = $this->getData('id');
        //当前项目已加入的用户
        $ProjectUser_verify = new ProjectUser;
        $joined_projects_array = array();
        $joined_projects = $ProjectUser_verify->where('user_id', '=', $user_id)->select();

        foreach ($joined_projects as $PUdata)
        {
            $project_id = $PUdata->getData('project_id');
            $Project = Project::get($project_id);
            if($Project === null) die();
            $project_name = $Project->getData('project_name');
            array_push($joined_projects_array, $project_name);
        }

        if(!$joined_projects_array)
        {
            array_push($joined_projects_array, "该用户未加入任何项目");
        }

        return $joined_projects_array;
    }

    public function getJoinedProjectIds()
    {
        $user_id = $this->getData('id');
        //当前项目已加入的用户
        $ProjectUser_verify = new ProjectUser;
        $joined_projects_array = array();
        $joined_projects = $ProjectUser_verify->where('user_id', '=', $user_id)->select();
        foreach ($joined_projects as $PUdata)
        {
            $project_id = $PUdata->getData('project_id');
            array_push($joined_projects_array, $project_id);
        }
        return $joined_projects_array;
    }

    /**
     * 判断用户是否已登录
     * @return boolean 已登录true 未登录false
     * @author  panjie <panjie@yunzhiclub.com>
     */
    static public function isLogin()
    {
        $userId = session('user');

        // isset()和is_null()是一对反义词
        if (isset($userId)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 用户登录
     * @param  string $username 用户名
     * @param  string $password 密码
     * @return bool   成功返回true，失败返回false。
     */
    static public function login($username, $password)
    {
        // 验证用户是否存在
        $map = array('username' => $username);
        $User = self::get($map);
        
        if (!is_null($User)) {
            // 验证密码是否正确
            if ($User->checkPassword($password)) {
                // 登录
                session('user', $User);

                //当前登录用户已加入的项目
                $ProjectUser_verify = new ProjectUser;
                $joined_projects_array = array();
                $joined_projects = $ProjectUser_verify->where('user_id', '=', $_SESSION['think']['user']->getData('id'))->select();
                foreach ($joined_projects as $PUdata)
                {
                    array_push($joined_projects_array, $PUdata->getData('project_id'));
                }
                session("joined_projects", $joined_projects_array);
                return true;
            }
        }
        return false;
    }

    /**
     * 注销
     * @return bool  成功true，失败false。
     * @author panjie
     */
    static public function logOut()
    {
        // 销毁session中数据
        session('user', null);
        session('joined_projects', null);
        session('now_controller', null);
        return true;
    }

    static public function usernameIsExist($username)
    {
        $User = new User;
        $Users = $User->where('username', '=', $username)->select();
        if ($Users === [])
        {
            return false;
        }
        return true;
    }

    
}