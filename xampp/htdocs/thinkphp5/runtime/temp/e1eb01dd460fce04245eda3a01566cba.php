<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\teacher\add.html";i:1689505920;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>新增数据</title>
</head>

<body class="contanier">
    <div class="row">
        <div class="col-md-12">
            <form action="insert" method="post">
                <label>姓名:</label>
                <input type="text" name="name" />
                <label>用户名:</label>
                <input type="text" name="username" />
                <label>性别:</label>
                <select name="sex">
                    <option value="0">男</option>
                    <option value="1">女</option>
                </select>
                <label>邮箱:</label>
                <input type="email" name="email" />
                <button type="submit">保存</button>
            </form>
        </div>
    </div>
</body>

</html>