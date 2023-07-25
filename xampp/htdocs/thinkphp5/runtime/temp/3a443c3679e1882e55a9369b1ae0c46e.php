<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\xampp\htdocs\thinkphp5\public/../application/index\view\course\add.html";i:1689767885;}*/ ?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <title>添加</title>
</head>

<body>
    <form action="<?php echo url('save'); ?>" method="post">
        <label for="name">name:</label>
        <input type="text" name="name" id="name" />
        <?php if(is_array($Course->Klasses()->select()) || $Course->Klasses()->select() instanceof \think\Collection): $i = 0; $__LIST__ = $Course->Klasses()->select();if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$klass): $mod = ($i % 2 );++$i;?>
            <input type="checkbox" name="klass_id[]" id="klass_id_<?php echo $klass->id; ?>" value="<?php echo $klass->id; ?>" <?php if($Course->getIsChecked($klass) == 'true'): ?>checked="checked"<?php endif; ?>/>
            <label for="klass_id_<?php echo $klass->id; ?>"><?php echo $klass->name; ?></label>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <button type="submit">submit</button>
    </form>
</body>

</html>