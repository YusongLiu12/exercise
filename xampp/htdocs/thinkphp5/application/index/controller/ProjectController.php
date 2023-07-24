<?php
namespace app\index\controller; // 该文件的位于application\index\controller文件夹
use think\Controller;   // 用于与V层进行数据传递
use app\common\model\Project;       // 项目模型
use app\common\model\User;
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

    public function save()
    {
        // 实例化
        $Project = new Project;

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


}