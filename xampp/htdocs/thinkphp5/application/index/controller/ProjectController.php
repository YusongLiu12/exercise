<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
use app\common\model\ProjectUser;
use think\Request;
/**
 * 项目管理
 */
class ProjectController extends Controller
{
    public function __construct()
    {
        // 调用父类构造函数(必须)
        parent::__construct();

        // 验证用户是否登陆
        if (!User::isLogin()) {
            return $this->error('plz login first', url('Login/index'));
        }
        $_SESSION['now_controller'] = 'Project';
    }

    public function add()
    {
        // 实例化
        $Project = new Project;

        // 设置默认值
        $Project->id = 0;
        $Project->project_name = '';
        $Project->access_type = 0;
        $this->assign('Project', $Project);
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

            // 要删除的对象存在
            if (is_null($Project)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Project->delete()) {
                return $this->error('删除失败:' . $Project->getError());
            }

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 

        // 进行跳转 
        return $this->success('删除成功', $Request->header('referer')); 
    }

    public function edit()
    {
        $id = Request::instance()->param('id/d');
        $Project = Project::get($id);

        if (is_null($Project)) {
            return $this->error('不存在ID为' . $id . '的记录');
        }

        $this->assign('Project', $Project);
        return $this->fetch("edit_or_add");
    }

    public function index()
    {
        $add_keyword = "新建项目";
       // 获取查询信息
        $project_name = input('get.project_name');

        $pageSize = 5; // 每页显示5条数据

        // 实例化Klass
        $Project = new Project; 

        // 按条件查询数据并调用分页
        $Projects = $Project->where('project_name', 'like', '%' . $project_name . '%')->paginate($pageSize, false, [
            'query'=>[
                'project_name' => $project_name,
                ],
            ]); 

        // 向V层传数据
        $this->assign('Projects', $Projects);
        $this->assign('add_keyword', $add_keyword);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function project_join()
    {
        // 实例化
        $ProjectUser = new ProjectUser;

        $project_id = Request::instance()->param("id/d");
        $user_id = $_SESSION['think']['user']->getData("id");
        $ProjectUser->project_id = $project_id;
        $ProjectUser->user_id = $user_id;

        // 加入用户
        if (!($ProjectUser->validate(true)->save())) {
            return $this->error('操作失败' . $Project->getError());
        }
    
        // 成功跳转至index触发器
        array_push($_SESSION['think']['joined_projects'], $project_id);
        return $this->success('操作成功', url('index'));
    }

    public function save()
    {
        // 实例化
        $Project = new Project;
        $Project->create_user = $_SESSION['think']['user']->getData('id');

        // 新增数据
        if (!$this->saveProject($Project)) {
            return $this->error('操作失败' . $Project->getError());
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
    }

    private function saveProject(Project &$Project) 
    {
        // 写入要更新的数据
        $Project->project_name = input('post.project_name');
        $Project->access_type = input('post.access_type');

        // 更新或保存
        return $Project->validate(true)->save();
    }

    public function update()
    {
        // 接收数据，取要更新的关键字信息
        $id = Request::instance()->post('id/d');

        // 获取当前对象
        $Project = Project::get($id);

        if (!is_null($Project)) {
            if (!$this->saveProject($Project, true)) {
                return $this->error('操作失败' . $Project->getError());
            }
        } else {
            return $this->error('当前操作的记录不存在');
        }
    
        // 成功跳转至index触发器
        return $this->success('操作成功', url('index'));
    }

    


}