<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
use app\common\model\Task;
use app\common\model\ProjectUser;
use think\Request;
use think\Loader;
/**
 * 项目管理
 */
class ProjectController extends IndexController
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        $_SESSION['now_controller'] = 'Project';
    }

    public function add()
    {
        // 实例化
        $Project = new Project;
        $User = $_SESSION['think']['user'];

        // 设置默认值
        $Project->id = 0;
        $Project->project_name = '';
        $Project->access_type = 0;
        $Project->create_user = 0;
        $this->assign('Project', $Project);
        $this->assign('User', $User);
        // 调用edit模板
        return $this->fetch('edit_or_add');
    }

    public function delete()
    {
        try {
            // 实例化请求类
            $Request = Request::instance();
            
            // 获取get数据
            $id = Request::instance()->param('id/d');
            
            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception('未获取到ID信息', 1);
            }

            // 获取要删除的对象
            $Project = Project::get($id);
            $ProjectUser = new ProjectUser;
            $Task = new Task;
            $inside_users_PUdatas = $ProjectUser->where('project_id', '=', $id)->select();
            $inside_tasks = $Task->where('project_id', '=', $id)->select();

            // 要删除的对象存在
            if (is_null($Project)) {
                throw new \Exception('不存在id为' . $id . '的项目，删除失败', 1);
            }

            // 删除项目
            if (!$Project->delete()) {
                return $this->error('删除失败:' . $Project->getError());
            }

            // 删除项目与其参与成员的关联数据
            foreach($inside_users_PUdatas as $PUdata)
            {
                if (!$PUdata->delete()) {
                    return $this->error('删除失败:' . $PUdata->getError());
                }
            }

            // 删除项目内的任务
            foreach($inside_tasks as $inside_task)
            {
                if (!$inside_task->delete()) {
                    return $this->error('删除失败:' . $inside_task->getError());
                }
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 进行跳转 
        return $this->success('删除成功', url('index').'?page='.$_SESSION['think']['delete_page']); 
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');
        $Project = Project::get($id);

        if (is_null($Project)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }
        $User = $_SESSION['think']['user'];
        $joined_projects = $User->getJoinedProjectIds();

        $this->assign('Project', $Project);
        $this->assign('User', $User);
        $this->assign('joined_projects', $joined_projects);
        return $this->fetch("edit_or_add");
    }

    public function index()
    {
        $add_keyword = "新建项目";
       // 获取查询信息
        $project_name = input('get.project_name');

        $pageSize = 5; // 每页显示5条数据
        $page = input('get.page');
        if (is_null($page))
        {
            $page = 1;
        }
        session('page', $page);
        session('delete_page', $page);

        // 实例化
        $Project = new Project; 
        $User = new User;

        // 按条件查询数据并调用分页
        $Projects = $Project->where('project_name', 'like', '%' . $project_name . '%')->order('id asc')->paginate($pageSize, false, [
            'query'=>[
                'project_name' => $project_name,
                ],
            ]); 

        $User = $_SESSION['think']['user'];
        $joined_projects = $User->getJoinedProjectIds();

        // 向V层传数据
        $this->assign('Projects', $Projects);
        $this->assign('User', $User);
        $this->assign('add_keyword', $add_keyword);
        $this->assign('joined_projects', $joined_projects);
        $this->assign('pageSize', $pageSize);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function invite()
    {
        $id = Request::instance()->param('id/d');
        $Project = Project::get($id);

        if (is_null($Project)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        $outside_users = $Project->getOutsideUsers();

        $this->assign('Project', $Project);
        $this->assign('outside_users', $outside_users);
        return $this->fetch();
    }

    public function invite_save()
    {
        // 实例化
        $project_id = input('post.id');
        $invited_users = Request::instance()->post('invited_users/a');
        $Project = Project::get($project_id);

        // 利用invited_users这个数组，拼接为包括project_id和user_id的二维数组。
        if (!is_null($invited_users)) {
            if (!$Project->Users()->saveAll($invited_users)) {
                return $this->error('信息保存错误：' . $Project->Users()->getError());
            }
        }
        return $this->success('操作成功', url('index').'?page='.$_SESSION['think']['page']);
    }

    public function project_join()
    {
        // 实例化
        $ProjectUser = new ProjectUser;

        $project_id = Request::instance()->param("id/d");
        $user_id = $_SESSION['think']['user']->getData("id");
        $ProjectUser->project_id = $project_id;
        $ProjectUser->user_id = $user_id;

        //验证输入数据
        $data = [
            'project_id' => $project_id,
            'user_id' => $user_id,
        ];

        $validate = Loader::validate('ProjectUser');

        if(!$validate->check($data))
        {
            return $this->error('操作失败 ' . $validate->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }

        // 加入用户
        if (!($ProjectUser->validate(true)->save())) {
            return $this->error('操作失败' . $Project->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index').'?page='.$_SESSION['think']['page']);
    }

    public function project_join_para($project_id, $user_id)
    {
        // 实例化
        $ProjectUser = new ProjectUser;

        $ProjectUser->project_id = $project_id;
        $ProjectUser->user_id = $user_id;

        //验证输入数据
        $data = [
            'project_id' => $project_id,
            'user_id' => $user_id,
        ];

        $validate = Loader::validate('ProjectUser');

        if(!$validate->check($data))
        {
            return $this->error('操作失败 ' . $validate->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }

        // 加入用户
        if (!($ProjectUser->validate(true)->save())) {
            return $this->error('操作失败' . $Project->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index').'?page='.$_SESSION['think']['page']);
    }

    public function save()
    {
        // 实例化
        $Project = new Project;
        $now_user = $_SESSION['think']['user']->getData('id');
        $Project->create_user = $now_user;

        // 新增数据,获取新增项目的id
        $add_project_id = $this->saveProject($Project);
        if (!$add_project_id) {
            return $this->error('操作失败' . $Project->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }
    
        //将创建者当前用户加入项目中
        $this->project_join_para($add_project_id, $now_user);
    }

    private function saveProject(Project &$Project) 
    {
        // 写入要更新的数据
        $Project->project_name = input('post.project_name');
        $Project->access_type = input('post.access_type');

        //验证输入数据
        $data = [
            'project_name' => $Project->project_name,
        ];

        $validate = Loader::validate('Project');

        if(!$validate->check($data))
        {
            return $this->error('操作失败 ' . $validate->getError(), url('index').'?page='.$_SESSION['think']['page']);
        }

        // 更新或保存
        $Project->validate(true)->save();

        return $Project->getData('id');
    }

    public function update()
    {
        // 接收数据，取要更新的关键字信息
        $id = Request::instance()->post('id/d');

        // 获取当前对象
        $Project = Project::get($id);

        if (!is_null($Project)) {
            if (($this->saveProject($Project, true)) === false) {
                return $this->error('操作失败' . $Project->getError(), url('index').'?page='.$_SESSION['think']['page']);
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }

        // 成功跳转至index触发器
        return $this->success('更新成功', url('index').'?page='.$_SESSION['think']['page']);
    }

    


}