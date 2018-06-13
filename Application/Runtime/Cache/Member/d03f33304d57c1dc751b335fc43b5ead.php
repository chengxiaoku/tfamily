<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($page_title); ?> | 会员中心</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo ASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS;?>bootstrap/css/skin/skin-purple.min.css" rel="stylesheet" type="text/css" />

    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo ASSETS;?>fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo ASSETS;?>fonts/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo ASSETS;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ASSETS;?>css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo ASSETS;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo ASSETS;?>plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS;?>plugins/jquery-validate/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS;?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS;?>js/app.min.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo ASSETS;?>js/html5shiv.min.js"></script>
    <script src="<?php echo ASSETS;?>js/respond.min.js"></script>
    <![endif]-->
    <link href="<?php echo ASSETS;?>css/custom.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo ASSETS;?>plugins/bootbox.js"></script>
</head>

<body class="skin-purple">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">TF</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">会员中心</span>
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
<aside class="main-sidebar">
    <section class="sidebar">

        <ul class="sidebar-menu">

            <?php if(CONTROLLER_NAME == 'Index' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('index/index');?>">
                        <i class="fa fa-dashboard"></i> <span>控制面板</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('index/index');?>">
                        <i class="fa fa-dashboard"></i> <span>控制面板</span>
                    </a>
                </li><?php endif; ?>


            <?php if(CONTROLLER_NAME == 'Member' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('member/index');?>">
                        <i class="fa fa-user"></i>
                        <span>我的会员</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('member/index');?>">
                        <i class="fa fa-user"></i>
                        <span>我的会员</span>
                    </a>
                </li><?php endif; ?>


            <li>
                <a href="<?php echo U('team/index');?>">
                    <i class="fa fa-th"></i>
                    <span>我的团队</span>
                </a>
            </li>
            <?php if(CONTROLLER_NAME == 'Fans' && ACTION_NAME == 'index'): ?><li class="active">
                <a href="<?php echo U('fans/index');?>">
                    <i class="fa fa-th"></i>
                    <span>我的粉丝</span>
                </a>
            </li><?php else: ?>
              <li>
                 <a href="<?php echo U('fans/index');?>">
                     <i class="fa fa-th"></i>
                      <span>我的粉丝</span>
                 </a>
              </li><?php endif; ?>

            <li>
                <a href="<?php echo U('orders/index');?>">
                    <i class="fa fa-th"></i>
                    <span>我的订单</span>
                </a>
            </li>

            <?php if(CONTROLLER_NAME == 'Money' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('money/index');?>">
                        <i class="fa fa-th"></i>
                        <span>资金明细</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('money/index');?>">
                        <i class="fa fa-th"></i>
                        <span>资金明细</span>
                    </a>
                </li><?php endif; ?>

            <li class=<?php echo ($active); ?>>
                <a href="<?php echo U('notice/index');?>">
                    <i class="fa fa-th"></i>
                    <span >我的消息</span>
                </a>
            </li>

            <?php if(CONTROLLER_NAME == 'Balance' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('balance/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我的余额</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('balance/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我的余额</span>
                    </a>
                </li><?php endif; ?>

            <?php if(CONTROLLER_NAME == 'Cash' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('Cash/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我要提现</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('Cash/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我要提现</span>
                    </a>
                </li><?php endif; ?>

  			<li>
                <a href="<?php echo U('bank/index');?>">
                    <i class="fa fa-th"></i>
                    <span>我的银行卡</span>
                </a>
            </li>

            <?php if(CONTROLLER_NAME == 'Referee' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('Referee/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我要推广</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('Referee/index');?>">
                        <i class="fa fa-th"></i>
                        <span>我要推广</span>
                    </a>
                </li><?php endif; ?>

            <li class="header"></li>

            <li class="treeview">
                <a href="<?php echo U('ui/blank');?>">
                    <i class="fa fa-th"></i>
                    <span>空白页面</span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo U('ui/index');?>">
                    <i class="fa fa-th"></i>
                    <span>页面UI参考</span>
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
        <!--统计区块-->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa ion-ios-people-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-filing-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-paperplane-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">90<small>%</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa ion-ios-paw-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">41,410</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-lightbulb-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">760</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-list-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">统计区块</span>
                        <span class="info-box-number">2,000</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /统计区块-->
    </section>
    <!-- /.content  -->

</div>
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