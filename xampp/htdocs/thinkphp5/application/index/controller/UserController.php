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
class UserController extends IndexController
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        $_SESSION['now_controller'] = 'User';
    }

    public function add()
    {
        // 实例化
        $User = new User;

        // 设置默认值
        $User->id = 0;
        $User->name = '';
        $User->username = '';
        $User->access_level = 0;
        $User->password = '';
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
            $User = User::get($id);
            $ProjectUser = new ProjectUser;
            $Project = new Project;
            $Task = new Task;
            $joined_project_PUdatas = $ProjectUser->where('user_id', '=', $id)->select();
            $create_projects = $Project->where('create_user', '=', $id)->select();
            $lead_tasks = $Task->where('leader_id', '=', $id)->select();

            // 要删除的对象存在
            if (is_null($User)) {
                throw new \Exception('不存在id为' . $id . '的用户，删除失败', 1);
            }

            // 删除对象
            if (!$User->delete()) {
                return $this->error('删除失败:' . $User->getError());
            }

            // 删除用户与其参与项目的关联数据
            foreach($joined_project_PUdatas as $PUdata)
            {
                if (!$PUdata->delete()) {
                    return $this->error('删除失败:' . $PUdata->getError());
                }
            }

            // 删除用户创建的项目
            foreach($create_projects as $create_project)
            {
                if (!$create_project->delete()) {
                    return $this->error('删除失败:' . $create_project->getError());
                }
            }

            // 删除用户负责的任务
            foreach($lead_tasks as $lead_task)
            {
                if (!$lead_task->delete()) {
                    return $this->error('删除失败:' . $lead_task->getError());
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
        return $this->success('删除成功', url('User/index').'?page='.$_SESSION['think']['page']); 
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');
        $User = User::get($id);

        if (is_null($User)) {
            return $this->error('不存在ID为' . $id . '的用户记录');
        }

        $this->assign('User', $User);
        return $this->fetch("edit_or_add");
    }

    public function index()
    {
        $add_keyword = "新增用户";
       // 获取查询信息
        $username = input('get.username');

        $pageSize = 5; // 每页显示5条数据
        $page = input('get.page');
        if (is_null($page))
        {
            $page = 1;
        }
        session('page', $page);

        // 实例化Klass
        $User = new User; 

        // 按条件查询数据并调用分页
        $Users = $User->where('username', 'like', '%' . $username . '%')->order('id asc')->paginate($pageSize, false, [
            'query'=>[
                'username' => $username,
                ],
            ]);

        // 向V层传数据
        $this->assign('User', $_SESSION['think']['user']);
        $this->assign('Users', $Users);
        $this->assign('add_keyword', $add_keyword);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function save()
    {
        // 实例化
        $User = new User;

        // 新增数据
        if (!$this->saveUser($User)) {
            return $this->error('操作失败' . $User->getError());
        }

        // 成功跳转至index触发器
        return $this->success('操作成功', url('User/index').'?page='.$_SESSION['think']['page']);
    }

    private function saveUser(User &$User) 
    {
        // 写入要更新的数据
        $User->username = input('post.username');
        $User->name = input('post.user_name');
        $User->password = input('post.password');
        $User->access_level = input('post.access_level');

        //验证输入数据
        $data = [
            'username' => $User->username,
            'name'  => $User->name,
            'access_level'  => $User->access_level,
            'password'  => $User->password,
        ];

        $validate = Loader::validate('User');

        if(!$validate->check($data))
        {
            return $this->error('操作失败 ' . $validate->getError(), url('User/index').'?page='.$_SESSION['think']['page']);
        }

        // 更新或保存
        return $User->validate(true)->save();
    }

    public function update()
    {
        // 接收数据，取要更新的关键字信息
        $id = input('post.id');

        // 获取当前对象
        $User = User::get($id);

        if (!is_null($User)) {
            if (!$this->saveUser($User, true)) {
                return $this->error('操作失败' . $User->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('User/index').'?page='.$_SESSION['think']['page']);
    }


}