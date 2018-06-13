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
    <!--主题内容-->
    <section class="content">

        <!--表格-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="<?php echo U('car/car_add');?>"><button type="button" class="btn btn-primary">添加汽车</button></a>
                        <div class="pull-right">
                            <form action="<?php echo U('car/search');?>" method="post">
                                <div class="input-group" style="width:250px;">
                                    <input  placeholder="搜索..."  class="center-block form-control " name="search" id="search" type="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!--box-header-->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover text-center">
                            <tbody>
                            <tr>
                                <th width="10%">名称</th>
                                <th width="10%">最低价格</th>
                                <th width="10%">最高价格</th>
                                <th width="10%">4s店名称</th>
                                <th width="10%">排量</th>
                                <th width="10%">变速箱</th>
                                <th width="10%">驱动</th>
                                <th width="10%">车身结构</th>
                                <th width="20%">管理</th>
                            </tr>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($val["title"]); ?></td>
                                    <td><?php echo ($val["price_min"]); ?></td>
                                    <td><?php echo ($val["price_max"]); ?></td>
                                    <td><?php echo ($val["company"]); ?></td>
                                    <td><?php echo ($val["emission"]); ?></td>
                                    <td>
                                        <?php if($val["drive"] == front): ?>前驱
                                            <?php elseif($val["drive"] == back): ?>后驱
                                            <?php elseif($val["drive"] == all): ?>四驱<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($val["gearbox"] == manual): ?>手动
                                            <?php elseif($val["gearbox"] == auto): ?>自动<?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($val["structure"] == hatchback): ?>掀背
                                            <?php elseif($val["structure"] == two): ?>两箱
                                            <?php elseif($val["structure"] == three): ?>三箱
                                            <?php elseif($val["structure"] == other): ?>其他<?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="car_edit('<?php echo ($val["id"]); ?>')">编辑</a>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="del('<?php echo ($val["id"]); ?>')">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </tbody>
                        </table>
                    </div><!--box-body -->

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
                </div><!-- box -->
            </div>
        </div>
        <!--查看详情-->
        <div class="modal fade" id="view_details">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">基本信息</h4>
                    </div>
                    <div class="modal-body" style="padding-top: 0px;">
                        <table class="table table-hover">

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default w100" data-dismiss="modal">关闭</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--删除-->
        <div class="modal fade" id="del">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">提示</h4>
                    </div>
                    <div class="modal-body">
                        <span class="glyphicon glyphicon-question-sign fa-2x text-red" style="font-size: 18px" ></span><span style="margin-left: 10px;font-size: 18px;color: red;">确认要删除选择的数据</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w100">确定</button>
                        <button type="button" class="btn btn-default w100" data-dismiss="modal">取消</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </section><!--content -->
</div>
<script type="text/javascript">
    //搜索内容返回
    var search = "<?php echo ($search); ?>";
    $("#search").val(search);
    //删除
    function del(id) {
        $("#del").modal({});
        $("#del button:contains('确定')").click(function () {
            location.href = "<?php echo U('car/del');?>&id="+id;
        })
    }
    function car_edit(id) {
        location.href = "<?php echo U('car/car_edit');?>&id="+id;
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