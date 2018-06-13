<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
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
                        <a class="btn btn-primary" href="admin.php?m=Admin&c=category&a=add">添加栏目</a>
                        <a class="btn btn-info" href="admin.php?m=Admin&c=category&a=addPage">添加单网页</a>
                        <a class="btn btn-warning" href="admin.php?m=Admin&c=category&a=addLink">添加外部连接</a>
                        <button class="btn btn-default" onclick="return order();">排序</button>
                        <div class="select pull-right">
                            <div style="width:250px; margin-left: 5px;" class="input-group">
                                <input id="sel" type="text" placeholder="搜索..." style="" class="center-block form-control  "
                                       name="">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" onclick="return sel();"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <form id="form" method="post" action="admin.php?m=Admin&c=category&a=order">
                            <table class="table table-hover" id="treeTable">
                                <thead>
                                <tr>
                                    <th width="10%" class="tc" style="vertical-align: middle !important;">展开</th>
                                    <th width="10%" class="tc" style="vertical-align: middle !important;">排序</th>
                                    <th width="10%" class="tc" style="vertical-align: middle !important;">栏目ID</th>
                                    <th width="40%" class="tc" style="vertical-align: middle !important;">栏目名称</th>
                                    <th width="10%" class="tc" style="vertical-align: middle !important;">类型</th>
                                    <th width="20%" class="tc" style="vertical-align: middle !important;">管理操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($content)): $i = 0; $__LIST__ = $content;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr data-tt-id="<?php echo ($data['id']); ?>" data-tt-parent-id="<?php echo ($data['parentid']); ?>">
                                        <td width="10%" class="tc" style="vertical-align: middle !important;"></td>
                                        <td width="10%" class="tc" style="vertical-align: middle !important;">
                                            <input type="text" value="<?php echo ($data['order_by']); ?>" name="<?php echo ($data['id']); ?>" class="center-block form-control w50 text-center">
                                        </td>
                                        <td width="10%" class="tc" style="vertical-align: middle !important;"><?php echo ($data['id']); ?></td>
                                        <td width="40%" class="tc" style="vertical-align: middle !important;"><?php echo ($data['name']); ?></td>
                                        <td width="10%" class="tc" style="vertical-align: middle !important;">
                                            <?php if($data['type'] == 'link'): ?>链接
                                                <?php elseif($data['type'] == 'page'): ?>
                                                单页
                                                <?php else: ?>
                                                分类<?php endif; ?>
                                        </td>
                                        <td width="20%" class="tc" style="vertical-align: middle !important;">
                                            <?php if($data['type'] != 'page'): ?><a class="btn btn-default btn-xs" href="admin.php?m=Admin&c=category&a=upd&type=<?php echo ($data['type']); ?>&pid=<?php echo ($data['id']); ?>">添加子栏目</a><?php endif; ?>
                                            <a class="btn btn-default btn-xs"
                                               href="admin.php?m=Admin&c=category&a=upd&type=<?php echo ($data['type']); ?>&id=<?php echo ($data['id']); ?>">编辑</a>
                                            <!-- <a class="btn btn-default btn-xs" href="#">模版</a> -->
                                            <a href="#" class="btn btn-default btn-xs"
                                               onclick="return del(<?php echo $data['id']; ?>);">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </form>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <ul class="pagination pull-right">
                            <?php echo ($page_html); ?>
                        </ul>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!--模态框-->
<div class="modal fade" id="myModa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <p class="modal-title" style="font-size:16px;">标题</p>
            </div>
            <div class="modal-body">
                <h5 style="color: red;"><span class="glyphicon glyphicon-exclamation-sign" style="margin-right:10px; "></span><span id="data_sum">内容</span></h5>
            </div>
            <div class="modal-footer">
                按钮
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<link type="text/css" rel="stylesheet" href="<?php echo ASSETS;?>plugins/jquery-treetable/jquery.treetable.css">
<script src="<?php echo ASSETS;?>plugins/jquery-treetable/jquery.treetable.js"></script>
<script type="text/javascript">
    function del(id) {
        $('#myModa div.modal-header p').text('警告');
        $('#myModa div.modal-body h5').css('color','red');
        $("#data_sum").text('确认要删除该栏目？');
        $('#myModa div.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">取消</button> <button id="DelId" type="button" class="btn btn-primary" onclick=""> 确认</button>');
        $('#DelId').attr('onclick','return SureDel('+id+");");
        $('#myModa').modal('show');
    }
    function SureDel(id) {
        $('#myModa').modal('hide');
        $.get('admin.php?m=Admin&c=category&a=del&id='+id,function (data) {
            if (data == 1){
                $('#myModa div.modal-header p').text('提示');
                $('#myModa div.modal-body h5').css('color','green');
                $("#data_sum").text('删除成功');
                $('#myModa div.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:location.reload();">确定</button>');
                $('#myModa').modal('show');
            }else{
                $('#myModa div.modal-header p').text('提示');
                $('#myModa div.modal-body h5').css('color','red');
                $("#data_sum").text('删除失败');
                $('#myModa div.modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">确定</button>');
                $('#myModa').modal('show');
            }
        })
    }

    function sel() {
        var like = $('#sel').val();
        var like_url = 'admin.php?m=Admin&c=category&a=index&like='+like;
        window.location.assign(like_url);
    }
    $("#treeTable").treetable({ expandable: true });
    function order() {
        $('#form').submit();
    }

</script>
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