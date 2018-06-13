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
<style type="text/css">
    .img_style{
        width: 64px;
        height: 64px;
    }
</style>
    <!-- 主体内容 -->
    <section class="content" style="background-color: white; margin: 15px;" >

        <div class="box-header">
            <div class="pull-right">
                <form action="<?php echo U('house/orders');?>" method="post">
                <label>过滤:</label>
                <span id="region">
                    <select class="form-control inline-block province" id="province_id" name="province_id" style="width: 130px;">
                        <option value="">≡ 请选择省 ≡</option>
                    </select>
                    <select class="form-control inline-block city" id="city_id" name="city_id" style="width: 130px;">
                        <option value="">≡ 请选择市 ≡</option>
                    </select>
                    <select class="form-control inline-block district" id="district_id" name="district_id" style="width: 130px;">
                        <option value="">≡ 请选择区 ≡</option>
                    </select>
                    <label class="control-label regionhint hide">
                        <i class="fa fa-times-circle-o"></i>
                        请选择省、市、区
                    </label>
                    <div style="width:250px; margin-left: 5px;" class="input-group fr">
                        <input type="text" id="select" placeholder="输入用户名或电话..." class="form-control" name="find">
                        <div class="input-group-btn" id="sel_id"><button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></div>
                    </div>
                </span>
                </form>
            </div>

        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12 ">
                <table class="table table-hover" style=" text-align: center" id="table">
                <tbody>
                <tr>
                    <th width="10%" style="text-align: center">姓名</th>
                    <th width="10%" style="text-align: center">电话</th>
                    <th width="15%" style="text-align: center">所选楼盘</th>
                    <th width="20%" style="text-align: center">地区</th>
                    <th width="10%" style="text-align: center">客户类型</th>
                    <th width="10%" style="text-align: center">下单日期</th>
                    <th width="10%" style="text-align: center">处理状态</th>
                    <th width="15%" style="text-align: center">操作</th>
                </tr>

                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                        <td class="tc"><?php echo ($row["name"]); ?></td>
                        <td><?php echo ($row["tel"]); ?></td>
                        <td><?php echo ($row["house_id"]); ?></td>
                        <td><?php echo ($data_city[($i-1)*3]); echo ($data_city[($i-1)*3+1]); echo ($data_city[($i-1)*3+2]); ?></td>
                        <td>
                            <a class="btn btn-default btn-xs">
                            <?php if($user_arr[$i-1][0]['user_type'] == 'province_agent'): ?>省级代理
                            <?php elseif($user_arr[$i-1][0]['user_type'] == 'city_agent'): ?>
                                市级代理
                            <?php elseif($user_arr[$i-1][0]['user_type'] == 'district_agent'): ?>
                                区级代理
                            <?php elseif($user_arr[$i-1][0]['user_type'] == 'member'): ?>
                                会员
                            <?php elseif($user_arr[$i-1][0]['user_type'] == 'partner'): ?>
                                合作商家
                            <?php elseif($user_arr[$i-1][0]['user_type'] == 'fan'): ?>
                                粉丝<?php endif; ?>
                            </a>
                        </td>
                        <td><?php echo ($row["addtime"]); ?></td>
                        <td>
                            <?php if($row["status"] == 'pending'): ?><a class="btn btn-info btn-default btn-xs">待处理</a>
                            <?php elseif($row["status"] == 'done'): ?>
                                <a class="btn-default btn-xs">已处理</a>
                            <?php elseif($row["status"] == 'doing'): ?>
                                <a class="btn btn-warning btn-xs">处理中</a><?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo U('House/house_mess',array('id_mess'=>$row['id']));?>" class="btn btn-default btn-xs">查看详情</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                </table>
            </div>
        </div>
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
    </section>
    <!-- /.content  -->

</div>
<!--省市区三级联动-->
<script src="<?php echo ASSETS;?>plugins/jquery.cityselect.js" type="text/javascript"></script>

<script type="text/javascript">
    //省市区三级联动
    $(function () {
        //省市区三级联动
        //注意三级联动结构：#region(自定义) > .province + .city + .district
        $("#region").citySelect({
            nodata: "none",
            required: false,
            province: null, //"河南省"
            city: null,
            district: null,
            url: "<?php echo U('admin/house/getCity');?>"
        });
    });

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