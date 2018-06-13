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
    <style type="text/css">
        .tc{
            text-align: right;
            position: relative;
            left: -95px;
        }
        .tx{
            text-align: left;
            position: relative;
            left: 95px;
        }

    </style>
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>

    <!-- 主体内容 -->
    <section class="content col-md-8" style="background-color: white; margin: 15px;position: relative;">
        <table class="table table-hover" style="margin-top: 15px; text-align: center; width: 100%;" id="table">
            <tbody>
            <tr>
                <th width="10%" class="tc">姓名：</th>
                <th width="20%" class="tx"><?php echo ($data[0]["name"]); ?></th>
            </tr>
            <tr>
                <td class="tc">电话：</td>
                <td class="tx"><?php echo ($data[0]["tel"]); ?></td>
            </tr>
            <tr>
                <td class="tc">性别：</td>
                <td class="tx">
                    <?php if($data[0]['sex'] == 'man'): ?>男
                        <?php else: ?>
                        女<?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tc">
                    <?php if($data[0]['order_type'] == 'house'): ?>意向购买楼盘：<?php else: ?>汽车品牌：<?php endif; ?>
                </td>
                <td class="tx">
                    <?php if($data[0]['order_type'] == 'house'): echo ($data[0]['house_name']); else: echo ($data[0]['car_brand']); endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tc">
                    <?php if($data[0]['order_type'] == 'house'): ?>户型：<?php else: ?>车型：<?php endif; ?></td>
                <td class="tx">
                    <?php if(is_array($hx_name)): $i = 0; $__LIST__ = $hx_name;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i; if($data[0]['order_type'] == 'house'): echo ($data[0]['house_my_type']); else: echo ($data[0]['like_car']); endif; endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tc">地区：</td>
                <td class="tx"><?php echo ($adress_s); echo ($adress_ss); echo ($adress_q); ?></td>
            </tr>
            <tr>
                <td class="tc">下单时间：</td>
                <td class="tx"><?php echo ($data[0]["add_time"]); ?></td>
            </tr>
            <tr>
                <td class="tc">订单状态：</td>
                <td class="tx">
                    <?php if($data[0]['status'] == 'pending'): ?><a class="btn btn-info btn-default btn-xs">待处理</a>
                        <?php elseif($data[0]['status'] == 'done'): ?>
                        <a class="btn-default btn-xs">已处理</a>
                        <?php elseif($data[0]['status'] == 'doing'): ?>
                        <a class="btn btn-warning btn-xs">处理中</a><?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tc">客户类型：</td>
                <td class="tx">
                    <?php if($user_typ == 'province_agent'): ?>省级代理
                        <?php elseif($user_typ == 'city_agent'): ?>
                        市级代理
                        <?php elseif($user_typ == 'district_agent'): ?>
                        区级代理
                        <?php elseif($user_typ == 'member'): ?>
                        会员
                        <?php elseif($user_typ == 'partner'): ?>
                        合作商家
                        <?php elseif($user_typ == 'fan'): ?>
                        粉丝<?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="tc">备注：</td>
                <td class="tx"><?php echo ($data[0]["message"]); ?></td>
            </tr>

            </tbody>
        </table>
        <button type="button" style="width: 90px; margin-left: 210px;"  onclick="history.go(-1)" class="btn btn-default">返回</button>
    </section>
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