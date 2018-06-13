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

        <!--表格-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-primary" href="admin.php?m=Admin&c=admin&a=role_add">添加角色</a>
                        <a class="btn  btn-danger" id="delall">全部删除</a>

                        <div class="select pull-right">
                            <div class="input-group" style="width:250px; margin-left: 5px;">
                                <input type="text" name="" class="form-control  " style="" placeholder="搜索...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody id="tbody">
                            <tr>
                                <th width="5%" class="tc">
                                    <input type="checkbox" id="selectAll" onclick="selAll ()">
                                </th>
                                <th width="5%">编号</th>
                                <th width="10%">角色名称</th>
                                <th width="10%">角色描述</th>
                                <th width="10%">状态</th>
                                <th width="10%">管理操作</th>
                            </tr>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><tr>
                                <td class="tc"><input type="checkbox" class="ckbox" value="<?php echo ($role["id"]); ?>"></td>
                                <td><?php echo ($role["id"]); ?></td>
                                <td><?php echo ($role["name"]); ?></td>
                                <td><?php echo ($role["description"]); ?></td>
                                <?php if($role["enabled"] == 1): ?><td id="enabled"><span class="label label-success">启用</span></td>
                                    <?php else: ?>
                                      <td id="enabled"><span class="label label-default">未启用</span></td><?php endif; ?>

                                <td>
                                <a class="btn btn-default btn-xs"  href="admin.php?m=Admin&c=admin&a=role_right&id=<?php echo ($rolre["id"]); ?>">权限设置</a>
                                <a class="btn btn-default btn-xs" href="admin.php?m=Admin&c=admin&a=role_update&id=<?php echo ($rolre["id"]); ?>">修改</a>
                                <a href="#" class="btn btn-default btn-xs" onclick="return del()">删除</a>
                                </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>



                            </tbody>
                        </table>
                    </div><!-- /.box-body -->

                    <div class="box-footer">

                    </div>

                </div><!-- /.box -->
            </div>
        </div>


    </section><!-- /.content -->

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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">警告</h4>
            </div>
            <div class="modal-body">
                <span style="color: red;font-size: 18px"><li class="glyphicon glyphicon-exclamation-sign" style="color: red;margin-right: 10px;"></li>是否删除数据</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">确认</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">





    //设置权限
    function setRights() {
        $('#myModal').modal({});


    }

    function fetchData() {
        var data = JSON.parse('<?php echo ($data); ?>');

        tbody = document.getElementById('tbody').innerHTML;


        for (var key in data) {
            var row = data[key];
            tbody=tbody+'<tr>'
            tbody=tbody+'<td class="tc"><input type="checkbox" class="ckbox" value="'+row.id+'"></td>'
            tbody=tbody+'<td>'+row.id+'</td>'
            tbody=tbody+'<td>'+row.name+'</td>'
            tbody=tbody+'<td>'+row.description+'</td>'
            if(row.enabled==1) {
                tbody=tbody+'<td id="enabled"><span class="label label-success">启用</span></td>'
            }else {
                tbody=tbody+'<td id="enabled"><span class="label label-default">未启用</span></td>'
            }

            tbody=tbody+'<td>'
            tbody=tbody+'<a class="btn btn-default btn-xs"  href="admin.php?m=Admin&c=admin&a=role-right&id='+row.id+'">权限设置</a>'
            tbody=tbody+'<a class="btn btn-default btn-xs" href="admin.php?m=Admin&c=admin&a=role_update&id='+row.id+'">修改</a>'
            tbody=tbody+'<a href="#" class="btn btn-default btn-xs" onclick="return del()">删除</a>'
            tbody=tbody+'</td>'
            tbody=tbody+'</tr>'

        }

        document.getElementById('tbody').innerHTML = tbody;





    }
    //单条数据的删除
    function del(){

        $('#myModal').modal('show');
    }
    fetchData();

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
</script>