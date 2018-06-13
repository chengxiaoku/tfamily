<?php if (!defined('THINK_PATH')) exit();?><!--公共头部-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($page_title); ?> | 管理后台</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo ASSETS;?>fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo ASSETS;?>fonts/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo ASSETS;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS;?>css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <!-- ./wrapper -->
    <script src="<?php echo ASSETS;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo ASSETS;?>plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS;?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS;?>js/app.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo ASSETS;?>js/html5shiv.min.js"></script>
    <script src="<?php echo ASSETS;?>js/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo ASSETS;?>plugins/bootbox.js"></script>
    <script src="<?php echo ASSETS;?>plugins/jquery-validate/jquery.validate.min.js"></script>
    <script src="<?php echo ASSETS;?>plugins/jquery-validate/localization/messages_zh.min.js"></script>
    <style>
        .error{
            color: red;
        }
    </style>
</head>

<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">TF</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">后台管理</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle">
                            <i class="glyphicon glyphicon-user"></i><span><?php echo ($uname); ?></span>
                        </a>
                    </li>

                    <li class="dropdown user user-menu">
                        <a class="dropdown-toggle" href="<?php echo U('Auth/logout');?>" >
                            <i class="glyphicon glyphicon-off"></i><span>安全退出</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<!--菜单-->
<!--左侧边栏-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <ul class="sidebar-menu">

            <?php echo ($menu_html); ?>

            <li class="header"></li>

            <li class="treeview">
                <a href="<?php echo U('ui/blank');?>">
                    <i class="fa fa-th"></i>
                    <span>空白页</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo U('ui/index');?>">
                    <i class="fa fa-th"></i>
                    <span>页面UI参考</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo U('ui/message');?>">
                    <i class="fa fa-th"></i>
                    <span>信息提示页面</span>
                </a>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <!--页面导航/面包屑-->
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>

    <!-- 主体内容 -->
    <section class="content">

        <div class="row">

            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">

                    <!-- form start -->
                    <form role="form"  id="form" method="post" action="admin.php?m=Admin&c=admin&a=inset">

                        <div class="box-body padding20">
                            <div class="form-group ">
                                <label for="">用户名<span class="required">*</span></label>
                                <div>
                                    <input type="text" name="name" placeholder="输入用户名称" id="name"class="form-control wp50 inline-block" onclick="remove (this)">
                                    <label class="control-label hide" for="inputError"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">密码<span class="required">*</span></label>
                                <div>
                                    <input type="password" placeholder="输入密码" name="pwd" id="pwd"class="form-control wp50 inline-block" onclick="remove (this)">
                                    <label class="control-label hide" for="inputError"></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">确认密码<span class="required">*</span></label>
                                <div>
                                    <input type="password" placeholder="输入确认密码" id="pwd2" onclick="remove (this)"class="form-control wp50 inline-block">
                                    <label class="control-label hide" for="inputError" ></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">昵称</label>
                                <div>
                                    <input type="text" placeholder="输入昵称" name="nickname"onclick="remove (this)" id="nickname"class="form-control wp50 inline-block">
                                    <label class="control-label hide" for="inputError" ></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">邮箱</label>
                                <div>
                                    <input type="email" placeholder="输入邮箱" name="email" id="email"onclick="remove (this)"class="form-control wp50 inline-block">
                                    <label class="control-label hide" for="inputError" "></label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">真实姓名<span class="required">*</span></label>
                                <div>
                                    <input type="text" placeholder="真实姓名" name="realname" id="realname"onclick="remove (this)" class="form-control wp50 inline-block">
                                    <label class="control-label hide" for="inputError" ></label>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="">所属角色</label>
                                <div>
                                    <select class="form-control wp50 inline-block" name="role_id" id="role_id">
                                      <option value="0">≡ 请选择会员组 ≡</option>
                                    <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><option value="<?php echo ($role["id"]); ?>"><?php echo ($role["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                                    </select>
                                    <label class="control-label hide" for="inputError" ></label>


                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer p20 ">
                            <button class="btn btn-primary w100" type="submit" onclick="return mySubmit()">保存</button>
                            <a onclick="history.go('-1')" class="btn btn-info w100 ml20" type="submit">返回</a>
                        </div>
                    </form>
                </div><!-- /.box -->

            </div>

        </div>


    </section><!-- /.content -->

    <!-- Content Header (Page header) -->


</div><!-- /.content-wrapper -->


<!-- 页面底部 -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>版本</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="#">T家园创业平台</a></strong> 版权所有.
</footer>
<div class='control-sidebar-bg'></div>

</body>
</html>
<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->


<script type="text/javascript">


    function update() {
        var data = '<?php echo ($data); ?>';
        var data = JSON.parse('<?php echo ($data); ?>');
        if (data!== null) {

            row=data[0];
            document.getElementById("name").value = row.name;
            document.getElementById("pwd").value = row.pwd;
            document.getElementById("pwd2").value = row.pwd;
            document.getElementById("nickname").value = row.nickname;
            document.getElementById("realname").value = row.realname;
            document.getElementById("email").value = row.email;
            document.getElementById("form").action="admin.php?m=Admin&c=admin&a=save&id="+row.id;
        }


    }

    function trim(str, charlist) {
        //  discuss at: http://locutus.io/php/trim/
        // original by: Kevin van Zonneveld (http://kvz.io)
        // improved by: mdsjack (http://www.mdsjack.bo.it)
        // improved by: Alexander Ermolaev (http://snippets.dzone.com/user/AlexanderErmolaev)
        // improved by: Kevin van Zonneveld (http://kvz.io)
        // improved by: Steven Levithan (http://blog.stevenlevithan.com)
        // improved by: Jack
        //    input by: Erkekjetter
        //    input by: DxGx
        // bugfixed by: Onno Marsman (https://twitter.com/onnomarsman)
        //   example 1: trim('    Kevin van Zonneveld    ')
        //   returns 1: 'Kevin van Zonneveld'
        //   example 2: trim('Hello World', 'Hdle')
        //   returns 2: 'o Wor'
        //   example 3: trim(16, 1)
        //   returns 3: '6'

        var whitespace = [
            ' ',
            '\n',
            '\r',
            '\t',
            '\f',
            '\x0b',
            '\xa0',
            '\u2000',
            '\u2001',
            '\u2002',
            '\u2003',
            '\u2004',
            '\u2005',
            '\u2006',
            '\u2007',
            '\u2008',
            '\u2009',
            '\u200a',
            '\u200b',
            '\u2028',
            '\u2029',
            '\u3000'
        ].join('')
        var l = 0
        var i = 0
        str += ''

        if (charlist) {
            whitespace = (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{}+$^:])/g, '$1')
        }

        l = str.length
        for (i = 0; i < l; i++) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(i)
                break
            }
        }

        l = str.length
        for (i = l - 1; i >= 0; i--) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(0, i + 1)
                break
            }
        }

        return whitespace.indexOf(str.charAt(0)) === -1 ? str : ''
    }

    function  remove(n) {

        var labelname = $(n).next('label');

        var label_text = '';
        labelname.html(label_text);
        labelname.addClass("hide");
        $(n).parent().parent().removeClass("has-error");

    }
    function mySubmit() {
        var name = $("#name").val()
        name = trim(name);
        var pwd = $("#pwd").val()
        pwd = trim(pwd);
        var pwd2 = $("#pwd2").val()
        pwd2 = trim(pwd2);
        var nickname = $("#nickname").val()
        nickname = trim(nickname);
        var email = $("#email").val()
        email = trim(email);
        var realname = $("#realname").val()
        realname = trim(email);
        var role = $("#role_id").val();


        if (name == "") {
            var inputname = $("#name");
            var labelname = inputname.next();
            var label_text = '<i class="fa fa-times-circle-o"></i> 用户名不能为空';
            labelname.html(label_text);
            labelname.removeClass("hide");
            inputname.parent().parent().addClass("has-error");
            inputname.focus();
            return false

        }
        if (pwd == "") {
            var inputpwd = $("#pwd");
            var labelpwd = inputpwd.next();
            var label_text = '<i class="fa fa-times-circle-o"></i> 密码不能为空';
            labelpwd.html(label_text);
            labelpwd.removeClass("hide");
            inputpwd.parent().parent().addClass("has-error");
            inputpwd.focus();
            return false

        }
        if (pwd2 == "") {
            var inputpwd2 = $("#pwd2");
            var labelpwd2 = inputpwd2.next();
            var label_text = '<i class="fa fa-times-circle-o"></i> 请输入确认密码';
            labelpwd2.html(label_text);
            labelpwd2.removeClass("hide");
            inputpwd2.parent().parent().addClass("has-error");
            inputpwd2.focus();
            return false

        }
        if (pwd2 == "") {
            var inputreal= $("#realname");
            var labelreal = inputreal.next();
            var label_text = '<i class="fa fa-times-circle-o"></i> 请输入真实姓名 ';
            labelreal.html(label_text);
            labelreal.removeClass("hide");
            inputreal.parent().parent().addClass("has-error");
            inputreal.focus();
            return false
        }
        if(pwd!==pwd2){
            var inputpwd2 = $("#pwd2");
            var labelpwd2 = inputpwd2.next();
            var label_text = '<i class="fa fa-times-circle-o"></i>  两次密码不一致';
            labelpwd2.html(label_text);
            labelpwd2.removeClass("hide");
            inputpwd2.parent().parent().addClass("has-error");
            inputpwd2.focus();
            return false
        }
        if(role==0){

            var inputrole = $("#role_id");
            var labelrole = inputrole.next();
            var label_text = '<i class="fa fa-times-circle-o"></i>  请选择角色';
            labelrole.html(label_text);
            labelrole.removeClass("hide");
            inputrole.parent().parent().addClass("has-error");
            inputrole.focus();
            return false
        }


    }
    update();


</script>