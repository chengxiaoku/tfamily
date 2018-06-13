<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> 移动端 | 会员中心</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo MASSETS;?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo MASSETS;?>fonts/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo MASSETS;?>fonts/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo MASSETS;?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
   
    <link href="<?php echo MASSETS;?>css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo MASSETS;?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo MASSETS;?>plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo MASSETS;?>plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo MASSETS;?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo MASSETS;?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="<?php echo MASSETS;?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo MASSETS;?>css/custom.css" rel="stylesheet" type="text/css" />


    <link href="<?php echo MASSETS;?>css/mobile.css" rel="stylesheet" type="text/css" />

  </head>

  <body class="skin-blue sidebar-mini mobile">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <!--<div class="pull-left" id="back" style="position:absolute;left: 25px;">
          <a href="javascript:history.go(-1)" class="arrow-back"></a>
        </div>-->

        <a href="javascript:void(0)" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">TF</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><i class="icon ion-ios-arrow-back" id="back" style="font-size: 25px;color: white;position:absolute;top:2px;left: 25px;"></i><?php echo ($data); ?><small style="font-size:12px;background-color: #FFF;color:#3c8dbc;padding: 3px;border-radius: 2px;position: relative;"><?php echo ($description); ?></small></span>
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
                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo MASSETS;?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                  <span class="hide">代理会员</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo MASSETS;?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    <p>
                      代理会员
                      <small>2015-06-03</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">个人中心</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">退出</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>
        </nav>



        <!--个人财务信息：我的余额+我的积分-->
        <div class="row my-account-excerpt">
          <div class="col-xs-6">
            <i class="ion ion-ios-gear-outline"></i> 余额：<strong><?php echo ($mone); ?></strong>
          </div>

          <div class="col-xs-6">
            <i class="ion ion-ios-gear-outline"></i> 积分：<strong><?php echo ($integray); ?></strong>
          </div>
        </div>
        

      </header>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            控制面板
            <small>Control panel</small>
          </h1>

          <ol class="breadcrumb">
            <li><a href="<?php echo U('index/index');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!--统计区块-->
          <div class="row row-box">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box  info-box-first">
                <a href="<?php echo U('orders/index');?>" class="block">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我的订单</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box ">
                <a href="<?php echo U('member/index');?>" class="block">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-ios-person-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我的会员</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('team/index');?>" class="block">
                  <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我的团队</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('fans/index');?>" class="block">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-heart-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我的粉丝</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box info-box-end">
                <a href="<?php echo U('notices/index');?>" class="block">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-email-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我的消息</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>
          <!-- /统计区块-->

          <!--统计区块-->
          <div class="row row-box">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('money/index');?>" class="block">
                  <span class="info-box-icon bg-aqua"><i class="ion ion-social-usd-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">资金明细</span>
                  </div>
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('bank/index');?>" class="block">
                  <span class="info-box-icon bg-red"><i class="ion ion-social-yen-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">银行信息</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('Referee/index');?>" class="block">
                  <span class="info-box-icon bg-green"><i class="ion ion-ios-redo-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我要推广</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('Cash/index');?>" class="block">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-download-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">我要提现</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="info-box">
              <a href="<?php echo U('member/index');?>" class="block">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-personadd-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">我的等级</span>
                </div><!-- /.info-box-content -->
              </a>
            </div><!-- /.info-box -->
          </div><!-- /.col -->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="info-box">
                <a href="<?php echo U('index/weixin');?>" class="block">
                  <span class="info-box-icon bg-yellow"><i class="ion ion-ios-personadd-outline"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">绑定微信</span>
                  </div><!-- /.info-box-content -->
                </a>
              </div><!-- /.info-box -->
            </div><!-- /.col -->

          </div>
          <!-- /统计区块-->
         
        </section>
        <!-- /.content -->

      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>版本</b> 1.0
        </div>
        <strong>Copyright &copy; 2016 <a href="#">T家园创业平台</a>.</strong> 版权所有.
      </footer>
      
      
      <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    <style>
      .main-sidebar, .left-side {
         transform: translate(-230px, 0px);
         display: none !important;
      }
      .content-wrapper, .right-side, .main-footer {
        margin-left: 0 !important;
      }
    </style>
    <script src="<?php echo MASSETS;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo MASSETS;?>plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo MASSETS;?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo MASSETS;?>js/app.min.js" type="text/javascript"></script>
      
<script>
  $('#back').click(function () {
    location.href='javascript:history.go(-1)';
  })
</script>
   
  </body>
</html>