<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
use think\Request;
/**
 * 项目管理
 */
class UserController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        $_SESSION['now_controller'] = 'User';

        // 验证用户是否登陆
        if (!User::isLogin()) {
            return $this->error('plz login first', url('Login/index'));
        }
        
        
    }

    public function add()
    {
        // 实例化
        $Teacher = new Teacher;

        // 设置默认值
        $Teacher->id = 0;
        $Teacher->name = '';
        $Teacher->username = '';
        $Teacher->sex = 0;
        $Teacher->email = '';
        $this->assign('Teacher', $Teacher);

        // 调用edit模板
        return $this->fetch('edit_or_add');
    }

    public function index()
    {
        $add_keyword = "新增用户";
       // 获取查询信息
        $username = input('get.username');

        $pageSize = 5; // 每页显示5条数据

        // 实例化Klass
        $User = new User; 

        // 按条件查询数据并调用分页
        $Users = $User->where('username', 'like', '%' . $username . '%')->paginate($pageSize, false, [
            'query'=>[
                'username' => $username,
                ],
            ]); 

        // 向V层传数据
        $this->assign('Users', $Users);
        $this->assign('add_keyword', $add_keyword);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }


}