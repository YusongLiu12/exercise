<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
use app\common\model\Task;
use app\common\model\ProjectUser;
use think\Request;

class TaskController extends IndexController
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        $_SESSION['now_controller'] = 'Task';
    }

    public function add()
    {
        // 实例化
        $Task = new Task;

        $project_id = Request::instance()->param('project_id/d');
        $Project = Project::get($project_id);

        $joined_users = $Project->getMemberIds();

        // 设置默认值
        $Task->id = 1;
        $Task->task_title = '';
        $Task->status = 0;
        $Task->leader_id = $Project->getData('create_user');
        $Task->start_time = 0;
        $Task->end_time = 0;    
        $this->assign('User', $_SESSION['think']['user']);    
        $this->assign('Task', $Task);
        $this->assign('Project', $Project);
        $this->assign('joined_users', $joined_users);

        // 调用edit模板
        return $this->fetch('edit_or_add');
    }

    public function edit()
    {
        //获取编辑的任务
        $task_id = Request::instance()->param('task_id/d');
        $project_id = Request::instance()->param('project_id/d');
        $Task = Task::get($task_id);
        $Project = Project::get($project_id);

        if (is_null($Task)) {
            return $this->error('不存在ID为' . $id . '的任务记录');
        }
        if (is_null($Project)) {
            return $this->error('不存在ID为' . $id . '的项目记录');
        }
        // 获取任务所属当前项目参与成员
        $joined_users = $Project->getMemberIds();

        $this->assign('User', $_SESSION['think']['user']);
        $this->assign('Task', $Task);
        $this->assign('Project', $Project);
        $this->assign('joined_users', $joined_users);

        return $this->fetch("edit_or_add");
    }

    public function index()
    {
        $add_keyword = "新增任务";

        $task_title = input('get.task_title');
        $task_status = input('get.task_status');

       // 获取任务所属当前项目
        $project_id = Request::instance()->param('id/d');
        $Project = Project::get($project_id);
        $this->assign('Project', $Project);

        $pageSize = 5; // 每页显示5条数据

        $page = input('get.page');
        if (is_null($page))
        {
            $page = 1;
        }
        session('page', $page);

        // 实例化Klass
        $Task = new Task; 
        $User = $_SESSION['think']['user'];
        // 按条件查询数据并调用分页
        $Tasks = $Task->where('project_id', '=', $project_id)->where('status', 'like', '%'.$task_status.'%')->where('task_title', 'like', '%'.$task_title.'%')->paginate($pageSize, false, [
            'query'=>[
                'task_title' => $task_title,
                'task_status' => $task_status,
                ],
            ]); 

        // 向V层传数据
        $this->assign('Tasks', $Tasks);
        $this->assign('User', $User);
        $this->assign('add_keyword', $add_keyword);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function save()
    {
        // 实例化
        $Task = new Task;

        //获取任务所属项目
        $project_id = input('post.project_id');
        $Project = Project::get($project_id);

        // 新增数据
        if (!$this->saveTask($Task)) {
            return $this->error('操作失败' . $Task->getError());
        }

        // 成功跳转至index触发器
        return $this->success('操作成功', url('Task/index?id=' . $Project->getData('id')).'?page='.$_SESSION['think']['page']);
    }

    private function saveTask(Task &$Task) 
    {
        // 写入要更新的数据
        $Task->task_title = input('post.task_title');
        $Task->status = input('post.task_status');
        $Task->leader_id = input('post.leader_id');
        $Task->project_id = input('post.project_id');
        $Task->start_time = input('post.start_time');
        $Task->end_time = input('post.end_time');
        //var_dump($Task);die();
        //var_dump($Task->getData('start_time'));
        //var_dump(input('post.start_time'));die();

        // 更新或保存
        return $Task->validate(true)->save();
    }

    public function update()
    {
        // 接收数据，取要更新的关键字信息
        $id = input('post.id');

        //获取任务所属项目
        $project_id = input('post.project_id');
        $Project = Project::get($project_id);

        // 获取当前对象
        $Task = Task::get($id);

        if (!is_null($Task)) {
            if (!$this->saveTask($Task, true)) {
                return $this->error('操作失败' . $Task->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('Task/index?id=' . $Project->getData('id')).'?page='.$_SESSION['think']['page']);
    }
}