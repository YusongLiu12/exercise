<?php
namespace app\index\controller;
use think\Controller;           // 用于与v层传递数据
use think\Request;              // 请求
use app\common\model\User;   // 教师模型

class LoginController extends Controller
{
    // 用户登录表单
    public function index()
    {
        // 显示登录表单
        return $this->fetch();
    }

    // 处理用户提交的登录数据
    public function login()
    {
        // 接收post信息
        $postData = Request::instance()->post();

        // 直接调用M层方法，进行登录。
        if (User::login($postData['username'], $postData['password'])) {
            return $this->success('登录成功', url('Project/index'));
        } else {
            return $this->error('登陆失败，用户名或密码错误', url('index'));
        }
    }

    // 注销
    public function logOut()
    {
        if (User::logOut()) {
            return $this->success('退出登录成功', url('index'));
        } else {
            return $this->error('退出登录失败', url('index'));
        }
    }

    public function test()
    {
        echo Teacher::encryptPassword('123');
        return;
    }
}