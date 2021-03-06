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

<style type="text/css">
    .img_style{
        width: 64px;
        height: 64px;
    }
    /*上页下页样式*/
    .prev,.next{
        padding:7px 12px;
        border: 1px silver solid;
    }
    .num,.current{
        font-size: 18px;
        padding: 4px 10px;
        border: 1px seashell solid;
    }
    .current{
        background-color: #00a2d4;
    }
</style>
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

        <!--表格-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-primary" href="admin.php?m=Admin&c=admin&a=add">添加管理员</a>
                        <a class="btn  btn-danger" id="delall" onclick="del(this,0)">批量删除</a>
                        <div class="select pull-right">
                            <div class="input-group" style="width:250px; margin-left: 5px;">
                                <input type="text" name="search" id="search" class="form-control  " style=""
                                       placeholder="搜索角色名...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" onclick="search ()"><i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody id="tbody">
                            <tr>
                                <th width="5%" class="tc">
                                    <input type="checkbox">
                                </th>
                                <th width="5%">编号</th>
                                <th width="10%">用户名</th>
                                <th width="10%">所属角色</th>
                                <th width="10%">最后登录IP</th>
                                <th width="10%">最后登录时间</th>
                                <th width="10%">真实姓名</th>
                                <th width="10%">管理操作</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class=" col-sm-7 ">
                                <div class="text-right">
                                    <ul class="pagination" id="pagination">
                                    <?php echo ($page); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

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
<!--模态框-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title">警告</h4>
            </div>
            <div class="modal-body">
                <span style="color: red;font-size: 18px"><li class="glyphicon glyphicon-exclamation-sign"
                                                             style="color: red;margin-right: 10px;"></li>是否删除数据</span>
            </div>
            <div class="modal-footer" id="myIf">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" > 确认</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/app.min.js" type="text/javascript"></script>

<script type="text/javascript">
    function delrow(id) {
        var id = id;



        var url = 'admin.php?m=Admin&c=admin&a=delrow';


        var url =url+'&mychk[0]='+id;

        window.location=url;



    }
    function removeSelected() {

        var boxs = document.getElementsByClassName("ckbox");
        var len = boxs.length;
        var get =''
        for (var i = 0; i < len; i++) {
            var _checkbox = boxs[0];

            if (_checkbox.checked == true) {
                var id=_checkbox.value

                get= get+'&mychk['+i+']='+id;
                var row = _checkbox.parentNode.parentNode;
                row.parentNode.removeChild(row);

            }
        }


        var url = 'admin.php?m=Admin&c=admin&a=del';


        var url =url+get;
        window.location.href=url;


    }
    //删除选中
    function selAll() {

        var checkbox = document.getElementById("selectAll");
        var boxs = document.getElementsByClassName("ckbox");
        for (var i = 0; i < boxs.length; i++) {
            var box = boxs[i];
            if (checkbox.checked) {
                box.checked = true;
            } else {
                box.checked = false;
            }
        }
    }

    function search() {
        str = document.getElementById("search").value;
        url = 'admin.php?m=Admin&c=admin&a=search&str=' + str;
        window.location.href = url;


    }
    function del(btn,num) {
        var btn=btn;
        value=num;

        if(value==0){
           myif=' <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> <button type="button" onclick="removeSelected()" class="btn btn-primary"  data-dismiss="modal"> 确认</button>'

        }else {
            myif=' <button type="button" class="btn btn-default" data-dismiss="modal">取消</button> <button type="button" onclick="delrow('+value+')" class="btn btn-primary" data-dismiss="modal" > 确认</button>'

        }

        document.getElementById("myIf").innerHTML= myif ;
        $('#myModal').modal('show');
    }

    function fetchData() {
        var data = JSON.parse('<?php echo ($data); ?>');

        tbody = '<tr> <th width="5%" class="tc"> <input id="selectAll" onclick="selAll()" type="checkbox"> </th> <th width="5%">编号</th> <th width="10%">用户名</th> <th width="10%">所属角色</th> <th width="10%">最后登录IP</th> <th width="10%">最后登录时间</th> <th width="10%">真实姓名</th> <th width="10%">管理操作</th> </tr>';


        for (var key in data) {
            var row = data[key];
            tbody = tbody + '<tr id="' + row.id + '">'
            tbody = tbody + '<td class="tc">'
            tbody = tbody + '<input class="ckbox"  value="'+row.id+'" type="checkbox">'
            tbody = tbody + '</td>'
            tbody = tbody + '<td>' + row.id + '</td>'
            tbody = tbody + '<td>' + row.name + '</td>'
            tbody = tbody + '<td>' + row.role_id + '</td>'
            tbody = tbody + '<td>' + row.last_ip + '</td>'
            tbody = tbody + '<td>' + row.last_time + '</td>'
            tbody = tbody + '<td>' + row.realname + '</td>'
            tbody = tbody + '<td><a class="btn btn-default btn-xs" href="admin.php?m=Admin&c=admin&a=update&id='+row.id+'">修改</a> <a href="#" class="btn btn-default btn-xs" onclick=" del(this,'+row.id+')">删除</a></td>'
            tbody = tbody + '</tr>'

        }

        document.getElementById('tbody').innerHTML = tbody;



    }
    fetchData();



</script>