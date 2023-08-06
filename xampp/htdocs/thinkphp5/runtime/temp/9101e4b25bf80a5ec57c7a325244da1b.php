<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\login\index.html";i:1690769259;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>标题</title>

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
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4 offset-4 border border-success p-2">
                <form action="<?php echo url('login'); ?>" method="POST">
                  <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" id="username" aria-describedby="请输入用户名"
                        name="username">
                    <small class="form-text text-muted">我们对您的输入信息将严格保密</small>
                  </div>
                  <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" id="password" 
                        name="password">
                  </div>
                  <button type="submit" class="btn btn-primary">登录</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>












