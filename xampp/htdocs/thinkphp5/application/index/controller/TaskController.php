<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
use app\common\model\Task;
use app\common\model\ProjectUser;
use think\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        // 验证用户是否登陆
        if (!User::isLogin()) {
            return $this->error('plz login first', url('Login/index'));
        }
        $_SESSION['now_controller'] = 'Task';
    }

    public function add()
    {
        // 实例化
        $Task = new Task;

        // 设置默认值
        $Task->id = 0;
        $Task->Task_name = '';
        $Task->access_type = 0;
        $this->assign('Task', $Task);
        // 调用edit模板
        return $this->fetch('edit_or_add');
    }

    public function edit()
    {
        //获取编辑的任务
        $id = Request::instance()->param('id/d');
        $Task = Task::get($id);

        if (is_null($Task)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        $User = new User;
        $this->assign('Task', $Task);
        $this->assign('User', $User);
        $this->assign('joined_users', $_SESSION['think']['joined_users']);

        return $this->fetch("edit_or_add");
    }

    public function index()
    {
        $add_keyword = "新增任务";

        $task_title = input('get.task_title');

       // 获取查询信息
        $project_id = Request::instance()->param('id/d');
        $Project = Project::get($project_id);
        session('project', $Project);

        //当前项目已加入的用户
        $ProjectUser_verify = new ProjectUser;
        $joined_users_array = array();
        $joined_users = $ProjectUser_verify->where('project_id', '=', $_SESSION['think']['project']->getData('id'))->select();
        foreach ($joined_users as $PUdata)
        {
            array_push($joined_users_array, $PUdata->getData('user_id'));
        }
        session("joined_users", $joined_users_array);

        $pageSize = 5; // 每页显示5条数据

        // 实例化Klass
        $Task = new Task; 
        $User = new User;
        // 按条件查询数据并调用分页
        $Tasks = $Task->where('project_id', '=', $project_id)->paginate($pageSize, false, [
            'query'=>[
                'task_title' => $task_title,
                ],
            ]); 

        // 向V层传数据
        $this->assign('Tasks', $Tasks);
        $this->assign('Task', $Task);
        $this->assign('User', $User);
        $this->assign('add_keyword', $add_keyword);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }
}