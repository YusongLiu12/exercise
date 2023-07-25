<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\user\index.html";i:1690273199;s:69:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\index.html";i:1690273108;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
用户管理
</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!-- Always remember to call the above files first before calling the bootstrap.min.js file -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <!--include css and js files-->
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/js/bootstrap.bundle.js">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/js/bootstrap.js">
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/bootstrap-4.6.2-dist/js/bootstrap.min.js">

    <!--include icon css-->
    <link rel="stylesheet" type="text/css" href="/thinkphp5/public/static/node_modules/bootstrap-icons/font/bootstrap-icons.min.css">
</head>

<body class="container">
    <!-- 菜单导航 -->
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">项目管理系统</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <!--$_SESSION['now_controller']在控制器构造函数中定义-->
                <li class="nav-item <?php if($_SESSION['now_controller'] == 'Project'): ?>active<?php endif; ?>">
                <a class="nav-link" href="<?php echo url('Project/index'); ?>">项目管理<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?php if($_SESSION['now_controller'] == 'User'): ?>active<?php endif; ?>">
                <a class="nav-link" href="<?php echo url('User/index'); ?>">用户管理</a>
                </li>
                </ul>
                
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle bi-person-fill" type="button" data-toggle="dropdown" aria-expanded="false">
                    欢迎您，<?php echo $_SESSION['think']['user']->getData('name'); if($_SESSION['think']['user']->getData('access_level') == '0'): ?>用户<?php else: ?>管理员<?php endif; ?>
                    </button>
                    <div class="dropdown-menu">
                        <small class="dropdown-item"><?php if($_SESSION['think']['user']->getData('access_level') == '0'): ?>欢迎加入我们，今后一起努力吧!<?php else: ?>您已拥有一级权限<?php endif; ?></small>
                        <a class="dropdown-item" href="<?php echo url('Login/logout'); ?>">退出登录</a>
                    </div>
                </div>

                </div>
            </nav>
        </div>
    </div>
    <!-- /菜单导航 -->
    <hr />
    <div class="row">
        <div class="col-md-4">
            
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" name="username" placeholder="用户名..." value="<?php echo input('get.username'); ?>">
        <button class="btn btn-primary bi-search" type="submit">&nbsp查询</button>
    </form>

        </div>
        <div class="offset-6 col-md-2 text-right">
            <a class="text-right btn btn-primary bi-journal-plus" href="<?php echo url('add'); ?>">&nbsp<?php echo $add_keyword; ?></a>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            
    <table class="table table-hover table-bordered">
        <tr class="info">
            <th>序号</th>
            <th>用户名</th>
            <th>姓名</th>
            <th>访问权限</th>
            <th <?php if($_SESSION['think']['user']->getData('access_level') == '0'): ?>hidden<?php endif; ?>>密码</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($Users) || $Users instanceof \think\Collection): $key = 0; $__LIST__ = $Users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_user): $mod = ($key % 2 );++$key;?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?php echo $_user->getData('username'); ?></td>
            <td><?php echo $_user->getData('name'); ?></td>
            <td><?php if($_user->getData('access_level') == '0'): ?>用户<?php else: ?>管理员<?php endif; ?></td>
            <td <?php if($_SESSION['think']['user']->getData('access_level') == '0'): ?>hidden<?php endif; ?>><?php echo $_user->getData('password'); ?></td>
            <td>
                <a class="btn btn-sm btn-info bi-eye" href="<?php echo url('delete?id=' . $_user->getData('id')); ?>">&nbsp参与项目</a>
                <a <?php if($_SESSION['think']['user']->getData('access_level') == '0'): ?>hidden<?php endif; ?> class="btn btn-sm btn-primary bi-pencil-square" href="<?php echo url('edit?id=' . $_user->getData('id')); ?>">&nbsp编辑</a>
                <a <?php if($_SESSION['think']['user']->getData('access_level') == '0'): ?>hidden<?php endif; ?> class="btn btn-sm btn-danger bi-trash" href="<?php echo url('delete?id=' . $_user->getData('id')); ?>">&nbsp删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </table>

            
    <?php echo $Users->render(); ?>

        </div>
    </div>
</body>

</html>