<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <form action="<?php echo U('admin/image/test');?>" method="post">
        <label>用户名</label><input name="name" >
        <label>密码</label><input name="pwd">
        <label>确认密码</label><input name="pwd1">
        <button>提交</button>
    </form>
</body>
</html>