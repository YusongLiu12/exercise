<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\teacher\edit.html";i:1689505920;}*/ ?>
<!DOCTYPE html>
<html lang="zh-hans">

<head>
    <meta charset="UTF-8">
    <title>编辑数据</title>
</head>

<body class="contanier">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo url('update'); ?>" method="post">
                <label>姓名:</label>
                <input type="hidden" name="id" value="<?php echo $teacher->getData('id'); ?>" />
                <input type="text" name="name" value="<?php echo $teacher->getData('name'); ?>" />
                <label>用户名:</label>
                <input type="text" name="username" value="<?php echo $teacher->getData('username'); ?>" />
                <label>性别:</label>
                <select name="sex">
                    <option value="0">男</option>
                    <option value="1" <?php if($teacher->getData('sex') == '1'): ?>selected="selected"<?php endif; ?>>女</option>
                </select>
                <label>邮箱:</label>
                <input type="email" name="email" value="<?php echo $teacher->getData('email'); ?>" />
                <button type="submit">保存</button>
            </form>
        </div>
    </div>
</body>

</html>