<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\course\edit.html";i:1689753671;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <title>编辑</title>
</head>
<body>
    <form action="<?php echo url('update'); ?>" method="post">
        <!--value属性定义填入的初始值，而hidden无法填入，故直接提交value-->
        <input type="hidden" name="id" value="<?php echo $Course->getData('id'); ?>" />
        <label for="name">name:</label><input type="text" name="name" id="name" value="<?php echo $Course->name; ?>"/>
        <?php if(is_array($Course->Klasses()->select()) || $Course->Klasses()->select() instanceof \think\Collection): $i = 0; $__LIST__ = $Course->Klasses()->select();if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$klass): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="klass_id[]" id="klass_id_<?php echo $klass->id; ?>" value="<?php echo $klass->id; ?>" />
            <label for="klass_id_<?php echo $klass->id; ?>"><?php echo $klass->name; ?></label>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <button type="submit">submit</button>
    </form>
</body>
</html>