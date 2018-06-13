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
            <!-- Main content -->
            <section class="content" style="background-color: white; margin: 15px;">

                <div class="box-header">
                    <form action="<?php echo U('house/indel_sel');?>" method="post" name="form1">
                    <a href="<?php echo U('house/add_house');?>" class="btn btn-primary"  id="insert">添加楼盘</a>
                    <a class="btn btn-danger"  id="delall">批量删除</a>
                   <!-- <div class="pull-right">
                        <input name="sec" class="form-control w150 inline-block" style="" placeholder="搜索楼盘..." type="text">
                        <button class="btn btn-default" onclick="return sel()"><i class="fa fa-search"></i></button>
                    </div>-->

                        <div style="width:250px; margin-left: 5px;" class="input-group fr">
                            <input type="text" placeholder="搜索楼盘..." class="form-control" name="sec">
                            <div onclick="return sel()" class="input-group-btn"><a class="btn btn-default"><i class="fa fa-search"></i></a></div>
                        </div>


                    </form>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12 ">
                            <table class="table table-hover" style="text-align: center" id="table">
                                <tbody>
                                <tr>
                                    <th width="10%" style="text-align: center"><input id="selectAll" type="checkbox">全选</th>
                                    <th width="20%" style="text-align: center">缩略图</th>
                                    <th width="15%" style="text-align: center">楼盘名称</th>
                                    <th width="10%" style="text-align: center">均价</th>
                                    <th width="15%" style="text-align: center">建筑类型</th>
                                    <th width="15%" style="text-align: center">开盘时间</th>
                                    <th width="15%" style="text-align: center">管理</th>
                                </tr>
                                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                                        <td class="tc"><input type="checkbox" name="ckbox" value="<?php echo ($row["id"]); ?>"></td>
                                        <td><img src="<?php echo ($row["thumb"]); ?>"  alt="缩略图" class="img_style"></td>
                                        <td><?php echo ($row["title"]); ?></td>
                                        <td><?php echo ($row["price"]); ?></td>
                                        <td><?php echo ($arr_new[$i-1]); ?></td>
                                        <td><?php echo (substr($row["open_time"],0,-8)); ?></td>
                                        <td>
                                            <a class="btn btn-default btn-xs" href="<?php echo U('house/house_update',array('update_id'=>$row['id']));?>">修改</a>
                                            <a href="#" class="btn btn-default btn-xs" onclick="return del(this)" del_id="<?php echo ($row["id"]); ?>">删除</a>
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
            <!-- /.content -->
            <!-- /.content -->

</div><!-- /.content-wrapper -->




<!--模态框-->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">删除操作</h4>
            </div>
            <div class="modal-body">
                <h5 style="color: red;"><span class="glyphicon glyphicon-exclamation-sign" style="margin-right:10px; "></span><span id="data_sum"></span></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary" onclick="del_ok()"> 确认</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- /.content  -->
<script type="text/javascript">
    //全选反选
    $(function (){
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
        //批量删除提示操作

        $("#delall").click(function (){
            var del_str = '';
            var len = $('input[name=ckbox]:checked').length;
            if(len>=1){
                $('input[name=ckbox]:checked').each(function (){
                    //$(this).val();
                    del_str +=','+$(this).val();
                });
                del_str = del_str.substring(1);
                del_id = del_str;
                $("#data_sum").text("确认删除这"+len+'条数据？');
            }else{
                $("#data_sum").text('没有选择数据！！');
            }

            $('#myModal').modal('show');
        })
    });

    //待删除数据的ID
    var del_id = 0;
    //单条数据的删除
    function del(a){
        del_id = $(a).attr("del_id");
        $("#data_sum").text('确认删除这条数据？');
        $('#myModal').modal('show');
    }


    //删除操作
    function del_ok(){
        location.href ='/tfamily/admin.php?m=Admin&c=house&a=house_del&del_id='+del_id;
    }
    //提交搜索的检测
    function sel(){
        var sec = $("input[name=sec]").val();
        sec = $.trim(sec);
        if(sec==''){
            return false;
        }
        form1.submit();
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