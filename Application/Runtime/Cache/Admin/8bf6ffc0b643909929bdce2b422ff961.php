<?php if (!defined('THINK_PATH')) exit();?><!--加载网页头部-->
<!DOCTYPE html>
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

<!--加载左侧菜单-->
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
<!--公告控制主体内容-->
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
        <!-- 公告表格 -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <!-- 1. 发布公告、批量删除按钮 -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <button class="btn btn-primary" onclick="location.href='<?php echo U(notices_add);?>';return false;">发布公告</button>
                                    <button class="btn btn-danger" onclick="delall()">批量删除</button>
                                </div>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover text-center">
                                <tbody>
                                <tr>
                                    <th width="15%" style="position: relative;left: 14px;"><input type="checkbox" id="checkboxall"><span>全选</span></th>
                                    <th width="30%">公告内容</th>
                                    <th width="15%">发布时间</th>
                                    <th width="20%">接收人</th>
                                    <th width="20%">操作</th>
                                </tr>
                                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$notice): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input type="checkbox" value="<?php echo ($notice[id]); ?>" name="item"></td>
                                        <td>通知:<?php echo ($notice["message"]); ?></td>
                                        <td><?php echo ($notice["add_time"]); ?></td>
                                        <td><?php echo ($notice["type"]); ?></td>
                                        <td><a href="javascript:void(0)" class="btn btn-default btn-xs del" onclick="update('<?php echo ($notice[id]); ?>','<?php echo ($notice[type]); ?>')" >编辑</a>
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs update" onclick="del('<?php echo ($notice[id]); ?>')" >删除</a></td>

                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                         </div><!-- /.box-body -->
                        <!--翻页-->
                        <div class="box-footer">
                            <div class="row">
                            <div class="col-sm-5">
                            </div>
                            <div class="col-sm-7 text-right">
                                <div class="result page"><?php echo ($page); ?></div>
                            </div>
                        </div>
                        </div>
                    </div><!-- /.box -->
            </div>
            </div>
        </section>
        <!-- /.content -->
        <section class="content">
        </section>
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
                        <button type="button" class="btn btn-primary" onclick="delurl()">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.content-wrapper -->
<!--js-->
<script>
    var id = [];
    /*控制模态框删除事件*/
    //多选删除
    function delall () {
        var deldata =[];
        $('input[name=item]:checked').each(function(){
            var check =$(this).val();
            deldata.push(check);
        });
        id = deldata;
        $('#myModalbody span').text('确认要删除的公告信息？');
        $('#myModal').modal();
    };
    //单选删除
    function del (delid) {
        id = delid;
        $('#myModalbody span').text('确认要删除这条公告信息？');
        $('#myModal').modal();
    };

    //删除链接
    function delurl () {
        location.href="?c=Notice&a=del&id="+id;
    }

    //编辑公告
    function update(upid,upname){
        location.href='?c=Notice&a=notices_add&id='+upid+'&username='+upname;
    }


    $(function(){
        /*全选全不选*/
        $('#checkboxall').change(function(){
            $('[name=item]:checkbox').prop('checked',$('#checkboxall').prop('checked'));
        });

        /*所有选中后，全选自动选中*/
        $('[name=item]:checkbox').change(function(){
            var sum = $('[name=item]:checkbox').length;
            var count = $('input[name=item]:checked').length;
            if (sum==count){
                $('#checkboxall').prop('checked',true);
            }else{
                $('#checkboxall').prop('checked',false);
            }

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