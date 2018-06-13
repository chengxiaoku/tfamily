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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header">
                        <a class="btn btn-primary" id="btn_add"
                           onclick="location.href='<?php echo U(ads_add);?>';return false;">
                            添加广告位
                        </a>
                        <a class="btn btn-danger" id="btn_del">
                            批量删除
                        </a>
                    </div>

                    <div class="box-body">
                        <div class="col-md-12 ">
                            <table class="table table-hover text-center" id="mytable">
                                <thead>
                                <tr>
                                    <th width="10%"><input type="checkbox">全选</th>
                                    <th width="15%">广告位名称</th>
                                    <th width="15%">版位尺寸</th>
                                    <th width="10%">广告数</th>
                                    <th width="50%">管理</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>

                                        <td><input type="checkbox"></td>
                                        <td><?php echo ($data["title"]); ?></td>
                                        <td><?php echo ($data["width"]); ?>*<?php echo ($data["height"]); ?></td>
                                        <td><?php echo ($data["count"]); ?></td>
                                        <td id="btn_more">
                                            <button class="btn btn-default btn-xs" onclick="add(this)"
                                                    p="<?php echo ($data['title']); ?>">添加广告
                                            </button>
                                            <button class="btn btn-default btn-xs"
                                                    onclick="ads('<?php echo U('admin/ad/ad', array('id' => $data[id]));?>')">
                                                广告列表
                                            </button>
                                            <button class="btn btn-default btn-xs">调用代码</button>
                                            <button class="btn btn-default btn-xs" onclick="return updata(this)" p = "<?php echo ($data["id"]); ?>">修改</button>
                                            <button class="btn btn-default btn-xs" onclick="return del(this)" p = "<?php echo ($data["id"]); ?>">删除</button>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="text-right">
                            <ul class="pagination">
                                <li id="example2_previous" class="paginate_button previous disabled"><a tabindex="0"
                                                                                                        data-dt-idx="0"
                                                                                                        aria-controls="example2"
                                                                                                        href="#">上一页</a>
                                </li>
                                <li class="paginate_button active"><a tabindex="0" data-dt-idx="1"
                                                                      aria-controls="example2" href="#">1</a></li>
                                <li class="paginate_button "><a tabindex="0" data-dt-idx="2" aria-controls="example2"
                                                                href="#">2</a></li>
                                <li class="paginate_button "><a tabindex="0" data-dt-idx="3" aria-controls="example2"
                                                                href="#">3</a></li>
                                <li class="paginate_button "><a tabindex="0" data-dt-idx="4" aria-controls="example2"
                                                                href="#">4</a></li>
                                <li class="paginate_button "><a tabindex="0" data-dt-idx="5" aria-controls="example2"
                                                                href="#">5</a></li>
                                <li class="paginate_button "><a tabindex="0" data-dt-idx="6" aria-controls="example2"
                                                                href="#">6</a></li>
                                <li id="example2_next" class="paginate_button next"><a tabindex="0" data-dt-idx="7"
                                                                                       aria-controls="example2"
                                                                                       href="#">下一页</a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
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
<script>

    function del(a) {
        //bootbox.alert(message, callback)
        //bootbox.prompt(message, callback)
        bootbox.confirm("确认要删除该广告位？", function (data) {
            var id = $(a).attr('p');
            if (data == false) {
                alert("取消");
            } else {
                alert("确定");
                window.location.href='/tfamily/admin.php?m=Admin&c=Ad&a=ads_del&id='+id;
            }
        })

    }
    function updata(a)
    {
        var id = $(a).attr('p');
        window.location.href='/tfamily/admin.php?m=Admin&c=Ad&a=ads_add&id='+id;

    }


    function ads(url) {
        window.location.href = url;
    }
    //    function ads(a){
    //        var  pp = $(a).attr('p');
    //
    //        window.location.href='/tfamily/admin.php?m=Admin&c=Ad&a=ad&id='+pp;
    //    }
    function add(a) {
        var pp = $(a).attr('p');
        window.location.href = '/tfamily/admin.php?m=Admin&c=Ad&a=ad_add&title=' + pp;
    }

</script>