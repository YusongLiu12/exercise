<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\project\edit_or_add.html";i:1690255055;s:75:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\edit_or_add.html";i:1690017424;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
        <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
<?php if($Project->id == ''): ?>新增项目<?php else: ?>编辑项目<?php endif; ?>
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

<body class="contanier">
    <div class="row mt-5">
        <div class="col-4 offset-4 border border-success p-2">
            
<?php $action = request()->action() === 'add' ? 'save' : 'update'; ?>
<form action="<?php echo url($action); ?>" method="POST"> 
    <input type="hidden" name="id" value="<?php echo $Project->id; ?>" />
    <div class="form-group">
        <label for="project_name">项目名称</label>
        <input type="text" class="form-control" id="username" aria-describedby="请输入项目名称" name="project_name">
    </div>
    <div class="form-group">
        <label>访问类型:</label>
        <select class="" name="access_type">
            <option value="0">公开</option>
            <option value="1" <?php if($Project->access_type == '1'): ?>selected="selected" <?php endif; ?>>私有</option>
        </select>
        <small name="$Project->getData('id')" value="1"}hidden{/eq}>若创建者不是您，将项目类型修改为私有</small>
    </div>

    <button type="submit" class="btn btn-primary">保存</button>
</form>

        </div>
    </div>
</body>

</html>