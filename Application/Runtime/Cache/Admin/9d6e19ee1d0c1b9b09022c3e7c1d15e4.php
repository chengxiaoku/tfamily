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
            <!--表格-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <a class="btn btn-primary" href="<?php echo U('Setting/team_lv_add');?>">添加团队级别</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th width="10%">级别名称</th>
                                    <th width="10%">积分奖励</th>
                                    <th width="10%">年薪</th>
                                    <th width="10%">粉丝奖励</th>
                                    <th width="10%">直推奖励</th>
                                    <th width="10%">组团奖励</th>
                                    <th width="10%">分红奖励</th>
                                    <th width="10%">操作</th>
                                </tr>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                                        <td><?php echo ($data["name"]); ?></td>
                                        <td><?php echo ($data["award_integral"]); ?></td>
                                        <td><?php echo ($data["year_salary"]); ?></td>
                                        <td><?php echo ($data["award_fans"]); ?></td>
                                        <td><?php echo ($data["award_direct"]); ?></td>
                                        <td><?php echo ($data["award_team"]); ?></td>
                                        <td><?php echo ($data["award_year"]); ?></td>
                                        <td>
                                            <a class="btn btn-default btn-xs" href="<?php echo U('Setting/team_lv_add',array('id'=>$data['id']));?>">编辑</a>
                                            <a href="#" onclick="del(this,'<?php echo ($data["id"]); ?>')" class="btn btn-default btn-xs del">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
<script>
    $.validator.setDefaults({
        submitHandler: function() {
            alert("提交事件!");
        }
    });
    $().ready(function() {
        $("#myform").validate({
            errorPlacement: function(error, element) {
                // Append error within linked label
                $( element )
                        .closest( "form" )
                        .find( "label[for='" + element.attr( "id" ) + "']" )
                        .append( error );
            },
            errorElement: "span",
            debug:true,
            rules:{
                title:"required",
                date:{
                    required:true
                },
                desc:{
                    required:true,
                    minlength:4
                }
            },
            messages:{
                title:"请输入标题",
                date:{
                    required:"请选择日期"
                },
                desc:{
                    required:"请输入描述",
                    minlength:"请至少输入4个字符"
                }

            }
        })
    });
</script>
<script type="text/javascript">
    /*控制模态框删除事件*/
    var id = '';
    function del(a,b) {
        $('#myModalbody span').text('确定删除此级别？');
        $('#myModal').modal();
        id = b;
        return false;
    }
    $('#button1').click(function () {
        location.href="?m=Admin&c=Setting&a=team_lv_del&id="+id;
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