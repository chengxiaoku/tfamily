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
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>
    <style type="text/css">
        .label_mess {
            width: 100px;
            text-align: right;
            margin-right: 15px;
        }
    </style>
    <!-- Main content -->
    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-solid">
                    <!-- form start -->

                    <div class="box-body">
                        <div class="select pull-right">

                            <div class="input-group" style="width:250px; margin-left: 5px;">
                                <input type="text" class="form-control " style="" placeholder="搜索..." value="" id="ss">
                                <div class="input-group-btn">
                                    <a id="sou">
                                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <form role="form">
                            <a type="button" class="btn btn-primary" id="insert" href="<?php echo U('News/add');?>">添加新闻</a>

                            <button type="button" class="btn btn-danger" id="delall">批量删除</button>

                            <table class="table table-hover text-center" style="margin-top: 15px; text-align: center"
                                   id="table">
                                <tbody>
                                <tr>
                                    <th width="10%" class="tc">
                                        <input id="selectAll" type="checkbox">全选
                                    </th>
                                    <th width="20%" class="tc">标题</th>
                                    <th width="20%">阅读人数</th>
                                    <th width="20%">发行日期</th>
                                    <th width="20%">管理操作</th>
                                </tr>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td width="10%" class="tc">
                                            <input type="checkbox" name="ckbox" value="<?php echo ($data["id"]); ?>">
                                        </td>
                                        <td><?php echo ($data["title"]); ?></td>
                                        <td><?php echo ($data["views"]); ?></td>
                                        <td><?php echo ($data["add_time"]); ?></td>
                                        <td>
                                            <a class="btn btn-default btn-xs"
                                               href="<?php echo U('News/upd',array('id'=>$data['id']));?>">修改</a>
                                            <a class="btn  btn-default btn-xs"
                                               onclick="del(this,'<?php echo ($data["id"]); ?>')">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class=" col-sm-7 ">
                                        <div class="text-right">
                                            <?php echo ($page); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body text-center" id="myModalbody">
                <i class="glyphicon glyphicon-info-sign fa-2x text-red " style="font-size: 18px;"></i>
                <span class="text-red" style="font-size:18px;margin-left: 10px;"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="button1">确定</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function () {
        $("#sou").click(function () {
            var keyword = $('#ss').val();

            if (keyword) {
                location.href = "admin.php?m=Admin&c=News&a=sel&keyword=" + keyword;
            } else {
                alert('无参数');
                return false;
            }


        });
    });
    $(function () {
        var boxs = document.getElementsByName('ckbox');
        $('#selectAll').click(function () {
            $('input[name=ckbox]').prop('checked', $(this).is(':checked'));
        });
        $('input[name=ckbox]').click(function () {
            var len = $('input[name=ckbox]:checked').length;
            if (len == boxs.length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

    })

    $("#delall").click(function () {
        var del_str = '';
        var len = $('input[name=ckbox]:checked').length;

        if (len >= 1) {
            $('input[name=ckbox]:checked').each(function () {
                //$(this).val();
                del_str += ',' + $(this).val();
            });
            del_str = del_str.substring(1);
            id = del_str;
            $("#myModalbody span").text("确认删除这" + len + '条数据？');
        } else {
            $("#myModalbody span").text('没有选择数据！！');

        }

        $('#myModal').modal('show');

    });
    /*控制模态框删除事件*/
    var id = '';
    function del(a, b) {
        $('#myModalbody span').text('确定删除该数据？');
        $('#myModal').modal();
        id = b;
        return false;
    }
    $('#button1').click(function () {
        if (id) {
            location.href = "admin.php?m=Admin&c=News&a=del&id=" + id;
        } else {
            return false;
        }

    })

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