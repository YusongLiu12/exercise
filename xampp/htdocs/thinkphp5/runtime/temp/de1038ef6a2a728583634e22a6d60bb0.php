<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:77:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\teacher\index.html";i:1689821272;s:69:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\index.html";i:1689824300;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>
教师管理
</title>
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-3.3.5-dist/css/bootstrap.min.css">
</head>

<body class="container">

    <!-- 菜单导航 -->
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="http://www.mengyunzhi.com">梦云智</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?php echo url('Teacher/index'); ?>">教师管理</a></li>
                            <li><a href="<?php echo url('Student/index'); ?>">学生管理</a></li>
                            <li><a href="<?php echo url('Klass/index'); ?>">班级管理</a></li>
                            <li><a href="<?php echo url('Course/index'); ?>">课程管理</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo url('Login/logout'); ?>">注销</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </div>
    <!-- /菜单导航 -->

    <div class="row">
        <div class="col-md-12">
            
            <hr />
            <div class="row">
                <div class="col-md-8">
                    <form class="form-inline">
                        <div class="form-group">
                            <label class="sr-only" for="name">姓名</label>
                            <input name="name" type="text" class="form-control" placeholder="姓名..." value=<?php echo input( 'get.name'); ?>>
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>&nbsp;查询</button>
                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <a href="<?php echo url('add'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;增加</a>
                </div>
            </div>
            <hr />  
            <table class="table table-hover table-bordered">
                <tr class="info">
                    <th>序号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>邮箱</th>
                    <th>用户名</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($teachers) || $teachers instanceof \think\Collection): $key = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_teacher): $mod = ($key % 2 );++$key;?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $_teacher->getData('name'); ?></td>
                    <td><?php if($_teacher->getData('sex') == '0'): ?>男<?php else: ?>女<?php endif; ?></td>
                    <td><?php echo $_teacher->getData('email'); ?></td>
                    <td><?php echo $_teacher->getData('username'); ?></td>
                    <td>
                        <a href="<?php echo url('edit?id=' . $_teacher->getData('id')); ?>">编辑</a> &nbsp;&nbsp;
                        <a href="<?php echo url('delete?id=' . $_teacher->getData('id')); ?>">删除</a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </table>
 
    <?php echo $teachers->render(); ?>

        </div>
    </div>
</body>

</html>