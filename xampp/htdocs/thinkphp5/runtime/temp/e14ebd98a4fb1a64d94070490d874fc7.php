<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:73:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\klass\add.html";i:1689664750;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>添加</title>
</head>
<body>
    <form action="<?php echo url('save'); ?>" method="post">
        <label for="name">name:</label><input type="text" name="name" id="name" />
        <label for="teacher">teacher:</label>
        <select name="teacher_id" id="teacher">
            <?php if(is_array($teachers) || $teachers instanceof \think\Collection): $i = 0; $__LIST__ = $teachers;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$_Teacher): $mod = ($i % 2 );++$i;?>
            <option value="<?php echo $_Teacher->getData('id'); ?>"><?php echo $_Teacher->getData('name'); ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
        <button type="submit">submit</button>
    </form>
</body>
</html>