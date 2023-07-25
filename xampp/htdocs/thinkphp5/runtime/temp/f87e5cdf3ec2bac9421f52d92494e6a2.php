<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\student\edit.html";i:1689685486;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>编辑</title>
</head>

<body class="contanier">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo url('update'); ?>" method="post">
                <label>姓名:</label>
                <input type="hidden" name="id" value="<?php echo $Student->getData('id'); ?>" />
                <input type="text" name="name" value="<?php echo $Student->getData('name'); ?>" />
                <label>学号:</label>
                <input type="text" name="num" value="<?php echo $Student->getData('num'); ?>" />
                <label>性别:</label>
                <input type="radio" name="sex" value="0" id="sex0" <?php if($Student->getData('sex') == '0'): ?>checked="checked"<?php endif; ?>/><label for="sex0">男</label>
                <input type="radio" name="sex" value="1" id="sex1" <?php if($Student->getData('sex') == '1'): ?>checked="checked"<?php endif; ?>/><label for="sex1">女</label>
                <label>班级</label>
                <select name="klass_id">
                <?php if(is_array($klasses) || $klasses instanceof \think\Collection): $i = 0; $__LIST__ = $klasses;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$klass): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo $klass->id; ?>" <?php if($klass->id == $Student->klass_id): ?>selected="selected"<?php endif; ?>><?php echo $klass->name; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                <label>邮箱:</label>
                <input type="email" name="email" value="<?php echo $Student->getData('email'); ?>" />
                <button type="submit">保存</button>
            </form>
        </div>
    </div>
</body>

</html>