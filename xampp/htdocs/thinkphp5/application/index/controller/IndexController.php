<?php
namespace app\index\controller;     //命名空间，也说明了文件所在的文件夹
use think\Controller;
use app\common\model\User;      // 引入教师
/**
 * IndexController既是类名，也是文件名，说明这个文件的名字为Index.php。
 * 由于其子类需要使用think\Controller中的函数，所以在此必须进行继承，并在构造函数中，进行父类构造函数的初始化
 */
class IndexController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        $url = url('Login/index');
        
        // 验证用户是否登陆
        if (!User::isLogin()) {
            header("Location: $url");die();
        }
    }

    public function index()
    {
    }
}