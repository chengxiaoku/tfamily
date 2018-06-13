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
    <script src="<?php echo ASSETS;?>js/app.min.js" type="text/javascript"></script>
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

            <?php if(CONTROLLER_NAME == 'User' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('user/index');?>">
                        <i class="fa fa-th"></i>
                        <span>用户管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('user/index');?>">
                        <i class="fa fa-th"></i>
                        <span>用户管理</span>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'House' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('house/index');?>">
                        <i class="fa fa-th"></i> <span>楼盘管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="<?php echo U('house/index');?>"><i class="fa fa-circle-o"></i>楼盘列表</a></li>
                        <li><a href="<?php echo U('house/orders');?>"><i class="fa fa-circle-o"></i>订单管理</a></li>
                    </ul>
                </li>
                <?php elseif(CONTROLLER_NAME == 'House' && ACTION_NAME == 'orders'): ?>
                <li class="active">
                    <a href="<?php echo U('house/index');?>">
                        <i class="fa fa-th"></i> <span>楼盘管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('house/index');?>"><i class="fa fa-circle-o"></i>楼盘列表</a></li>
                        <li class="active"><a href="<?php echo U('house/orders');?>"><i class="fa fa-circle-o"></i>订单管理</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('house/index');?>">
                        <i class="fa fa-th"></i> <span>楼盘管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('house/index');?>"><i class="fa fa-circle-o"></i>楼盘列表</a></li>
                        <li><a href="<?php echo U('house/orders');?>"><i class="fa fa-circle-o"></i>订单管理</a></li>
                    </ul>
                </li><?php endif; ?>

            <?php if(CONTROLLER_NAME == 'Category' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('category/index');?>">
                        <i class="fa  fa-th"></i>
                        <span>栏目管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('category/index');?>">
                        <i class="fa  fa-th"></i>
                        <span>栏目管理</span>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'News' && ACTION_NAME == 'index'): ?><li class="active">
                    <a href="<?php echo U('news/index');?>">
                        <i class="fa  fa-th"></i>
                        <span>新闻管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li>
                    <a href="<?php echo U('news/index');?>">
                        <i class="fa  fa-th"></i>
                        <span>新闻管理</span>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'Comment' && ACTION_NAME == 'index'): ?><li class="treeview active">
                    <a href="<?php echo U('comment/index');?>">
                        <i class="fa  fa-comment"></i>
                        <span>评论管理</span>
                        <small class="label pull-right bg-green">50条</small>
                    </a>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="<?php echo U('comment/index');?>">
                        <i class="fa  fa-comment"></i>
                        <span>评论管理</span>
                        <small class="label pull-right bg-green">50条</small>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'Ad' && ACTION_NAME == 'index'): ?><li class="treeview active">
                    <a href="<?php echo U('ad/index');?>">
                        <i class="fa fa-th"></i>
                        <span>广告管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="<?php echo U('ad/index');?>">
                        <i class="fa fa-th"></i>
                        <span>广告管理</span>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'Notice' && ACTION_NAME == 'index'): ?><li class="treeview active">
                    <a href="<?php echo U('notice/index');?>">
                        <i class="fa fa-th"></i>
                        <span>公告管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="<?php echo U('notice/index');?>">
                        <i class="fa fa-th"></i>
                        <span>公告管理</span>
                    </a>
                </li><?php endif; ?>
            <?php if(CONTROLLER_NAME == 'Finance' && ACTION_NAME == 'index'): ?><li class="treeview active">
                    <a href="<?php echo U('finance/index');?>">
                        <i class="fa fa-th"></i>
                        <span>财务管理</span>
                    </a>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="<?php echo U('finance/index');?>">
                        <i class="fa fa-th"></i>
                        <span>财务管理</span>
                    </a>
                </li><?php endif; ?>

            <li class="header"></li>
            <?php if(CONTROLLER_NAME == 'Admin' && ACTION_NAME == 'index'): ?><li class="treeview active">
                    <a href="#">
                        <i class="fa  fa-user"></i>
                        <span>管理员设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="<?php echo U('admin/index');?>"><i class="fa fa-circle-o"></i>管理员管理</a></li>
                        <li><a href="<?php echo U('admin/role');?>"><i class="fa fa-circle-o"></i>角色管理</a></li>
                    </ul>
                </li>
                <?php elseif(CONTROLLER_NAME == 'Admin' && ACTION_NAME == 'role'): ?>
                <li class="treeview active">
                    <a href="#">
                        <i class="fa  fa-user"></i>
                        <span>管理员设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('admin/index');?>"><i class="fa fa-circle-o"></i>管理员管理</a></li>
                        <li class="active"><a href="<?php echo U('admin/role');?>"><i class="fa fa-circle-o"></i>角色管理</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa  fa-user"></i>
                        <span>管理员设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('admin/index');?>"><i class="fa fa-circle-o"></i>管理员管理</a></li>
                        <li><a href="<?php echo U('admin/role');?>"><i class="fa fa-circle-o"></i>角色管理</a></li>
                    </ul>
                </li><?php endif; ?>

            <?php if(CONTROLLER_NAME == 'Setting' && ACTION_NAME == 'team'): ?><li class="treeview active">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>基础设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="<?php echo U('setting/team');?>"><i class="fa fa-circle-o"></i>团队设置</a></li>
                        <li><a href="<?php echo U('setting/option');?>"><i class="fa fa-circle-o"></i>参数设置</a></li>
                        <li><a href="<?php echo U('setting/site');?>"><i class="fa fa-circle-o"></i>网站设置</a></li>
                    </ul>
                </li>
                <?php elseif(CONTROLLER_NAME == 'Setting' && ACTION_NAME == 'option'): ?>
                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>基础设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('setting/team');?>"><i class="fa fa-circle-o"></i>团队设置</a></li>
                        <li class="active"><a href="<?php echo U('setting/option');?>"><i class="fa fa-circle-o"></i>参数设置</a></li>
                        <li><a href="<?php echo U('setting/site');?>"><i class="fa fa-circle-o"></i>网站设置</a></li>
                    </ul>
                </li>
                <?php elseif(CONTROLLER_NAME == 'Setting' && ACTION_NAME == 'site'): ?>
                <li class="treeview active">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>基础设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('setting/team');?>"><i class="fa fa-circle-o"></i>团队设置</a></li>
                        <li><a href="<?php echo U('setting/option');?>"><i class="fa fa-circle-o"></i>参数设置</a></li>
                        <li class="active"><a href="<?php echo U('setting/site');?>"><i class="fa fa-circle-o"></i>网站设置</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-th"></i>
                        <span>基础设置</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo U('setting/team');?>"><i class="fa fa-circle-o"></i>团队设置</a></li>
                        <li><a href="<?php echo U('setting/option');?>"><i class="fa fa-circle-o"></i>参数设置</a></li>
                        <li><a href="<?php echo U('setting/site');?>"><i class="fa fa-circle-o"></i>网站设置</a></li>
                    </ul>
                </li><?php endif; ?>

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

            <div class="row">

                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header">

                        </div><!-- /.box-header -->

                        <!-- form start -->
                        <form role="form" id="myform" action="<?php echo U('Setting/team_lv_add');?>" method="post">
                            <div class="box-body padding20">
                                <div class="form-group">
                                    <label for="">级别名称:</label>
                                    <div>
                                        <input type="hidden" value="<?php echo ($lists[id]); ?>" name="id">
                                        <input type="text" placeholder="输入级别名称" value="<?php echo ($lists[name]); ?>" name="name" class="form-control wp50" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">积分奖励:</label>
                                    <input type="text" placeholder="输入积分奖励" value="<?php echo ($lists[award_integral]); ?>" name="award_integral" class="form-control wp50" >
                                </div>

                                <div class="form-group">
                                    <label for="">年薪:</label>
                                    <input type="text" placeholder="输入年薪" value="<?php echo ($lists[year_salary]); ?>" name="year_salary" class="form-control wp50" >
                                </div>

                                <div class="form-group">
                                    <label for="">粉丝奖励</label>
                                    <input type="text" placeholder="粉丝奖励" value="<?php echo ($lists[award_fans]); ?>" name="award_fans" class="form-control wp50" >
                                </div>

                                <div class="form-group">
                                    <label for="">直推奖励:</label>
                                    <input type="text" placeholder="直推奖励" value="<?php echo ($lists[award_direct]); ?>" name="award_direct" class="form-control wp50" >
                                </div>

                                <div class="form-group">
                                    <label for="">组团奖励:</label>
                                    <input type="text" placeholder="组团奖励" value="<?php echo ($lists[award_team]); ?>" name="award_team" class="form-control wp50" >
                                </div>
                                <div class="form-group">
                                    <label for="">分红奖励:</label>
                                    <input type="text" placeholder="分红奖励" value="<?php echo ($lists[award_year]); ?>" name="award_year" class="form-control wp50" >
                                </div>
                                <div class="form-group">
                                    <label class="control-label">每个团队人数最低</label>
                                    <input type="text" placeholder="" name="teams" value="<?php echo ($lists[teams]); ?>" class="form-control inline-block w150">
                                    <label class="control-lable">个</label>
                                </div>

                                <div class="form-group">
                                    <label>等级描述:</label>
                                    <textarea placeholder="Enter ..." rows="5" name="description" class="form-control wp50"></textarea>
                                </div>


                            </div><!-- /.box-body -->

                            <div class="box-footer p20">
                                <button class="btn btn-primary w100" id="botton" type="submit">添加</button>
                                <a onclick="history.go('-1')" class="btn btn-info w100 ml20" type="submit">返回</a>
                            </div>
                        </form>
                    </div><!-- /.box -->



                </div>

            </div>

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
<script>
    $.validator.setDefaults({
        submitHandler: function() {
            myform.submit();
        }
    });
    $().ready(function() {
        $("#myform").validate({
            rules:{
                name:{
                    minlength:2,
                    maxlength:15,
                    required:true
                },
                award_integral:{
                    required:true,
                    digits:true,
                    maxlength:10
                },
                year_salary:{
                    required:true,
                    number:true,
                    maxlength:10
                },
                award_fans:{
                    required:true,
                    digits:true,
                    maxlength:10
                },
                award_direct:{
                    required:true,
                    digits:true,
                    maxlength:10
                },
                award_team:{
                    required:true,
                    digits:true,
                    maxlength:10
                },
                award_year:{
                    required:true,
                    number:true,
                    maxlength:10
                },
                teams:{
                    required:true,
                    digits:true,
                    maxlength:3
                },
                description:{
                    required:true,
                    minlength:4
                }
            },
            messages:{
                name:{
                    minlength:"请至少输入两个字符",
                    maxlength:"必须小于15位",
                    required:"请输入级别名称"
                },
                award_integral:{
                    required:"请输入积分奖励",
                    digits:"必须输入整数",
                    maxlength:"必须小于10位"
                },
                year_salary:{
                    required:"请输入年薪",
                    number:"请输入有效数字",
                    maxlength:"必须小于10位"
                },
                award_fans:{
                    required:"请输入粉丝奖励",
                    digits:"必须输入整数",
                    maxlength:"必须小于10位"
                },
                award_direct:{
                    required:"请输入直推奖励",
                    digits:"必须输入整数",
                    maxlength:"必须小于10位"
                },
                award_team:{
                    required:"请输入组团奖励",
                    digits:"必须输入整数",
                    maxlength:"必须小于10位"
                },
                award_year:{
                    required:"请输入分红奖励",
                    number:"请输入有效数字",
                    maxlength:"必须小于10位"
                },
                teams:{
                    required:"请输入数量",
                    digits:"必须输入整数",
                    maxlength:"必须小于3位"
                },
                description:{
                    required:"请输入描述",
                    minlength:"请至少输入4个字符"
                }
            }
        })
    });
</script>
<script>
    if ("<?php echo ($lists); ?>"){
        $('[name=description]').text("<?php echo ($lists[description]); ?>");
        myform.action="<?php echo U('Setting/team_lv_upd');?>";
        $('#botton').text("修改");
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