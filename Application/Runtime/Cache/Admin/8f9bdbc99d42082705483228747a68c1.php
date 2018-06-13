<?php if (!defined('THINK_PATH')) exit();?><!--公共头部-->
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

<!--菜单-->
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
    <!--页面导航/面包屑-->
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>
    <section class="content">
        <!--表格-->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <form action="<?php echo U('comment/comment_select');?>" method="post">
                        <!--<a class="btn btn-primary" href="#">批量审核</a>-->
                        <a class="btn  btn-danger inline-block" data-toggle="modal" data-target="#dellalltModal" onclick="return delAll()">批量删除</a>
                        <div class="select pull-right">
                            <!-- <i class="fa fa-fw  fa-reorder"></i> -->
                            <!--  <span> &nbsp; 过滤区块：</span> -->
                            <select id="audit" class="form-control w200 inline-block">
                                <option value="all">所有评论</option>
                                <option value="pending">待审核</option>
                                <option value="success">已审核</option>
                                <option value="reject">未通过</option>
                            </select>
                            <div style="width:250px; margin-left: 5px;" class="input-group fr">
                                <input type="text" id="select" value="<?php echo ($val); ?>" placeholder="检索..." class="form-control" name="find">
                                <div onclick="return select()" class="input-group-btn"><button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button></div>
                            </div>
                        </div>
                        </form>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover text-center">
                            <tbody>
                            <tr>
                                <th width="10%" class="tc">
                                    <input type="checkbox" id="checkbox">&nbsp;全选
                                </th>
                                <th width="10%">评论主题</th>
                                <th width="15%">评论内容</th>
                                <th width="5%">会员名</th>
                                <th width="10%">IP地址</th>
                                <th width="5%">状态</th>
                                <th width="10%">时间</th>
                                <th width="10%">管理</th>
                            </tr>
                            <form id="delform" action="<?php echo U('comment/comment_delall');?>" method="post">
                                <?php if(is_array($date)): $i = 0; $__LIST__ = $date;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="checkbox[]"></td>
                                        <td><?php echo ($vo["title"]); ?></td>
                                        <td><a href="javascript:viod(0)"><?php echo ($vo["content"]); ?></a></td>
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["ip"]); ?></td>
                                        <td>
                                            <?php if($vo["status"] == success): ?><small class="label bg-green">已审核</small>
                                                <?php elseif($vo["status"] == reject): ?><small class="label bg-red">未通过</small>
                                                <?php else: ?><small class="label bg-gray">待审核</small><?php endif; ?>
                                        </td>
                                        <td><?php echo ($vo["add_time"]); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-default btn-xs" onclick="return audit('<?php echo ($vo["id"]); ?>','<?php echo ($vo["status"]); ?>')">审核</a>
                                            <a class="btn btn-default btn-xs" href="<?php echo U('comment/comment_edit');?>&id=<?php echo ($vo["id"]); ?>">编辑</a>
                                            <a href="#" class="btn btn-default btn-xs"  onclick="return del('<?php echo ($vo["id"]); ?>')">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                            </form>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
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
                </div><!-- /.box -->
            </div>
        </div>

        <!-- 审核模态框 -->
        <div class="modal fade" id="auditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">审核：</h4>
                    </div>
                    <form action="<?php echo U('comment/comment_audit');?>" method="post">
                        <div class="modal-body text-center">
                            <label class="radio-inline">
                                <input type="radio" name="audit" value="pending"> 待审核
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="audit" value="reject"> 未通过
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="audit" value="success"> 审核通过
                            </label>
                            <input type="hidden" id="auditid"  name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">确定</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--删除模态框-->
        <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">提示：</h4>
                    </div>
                    <div class="modal-body text-center">
                        <span style="font-size: 18px;" class="text-red glyphicon glyphicon-exclamation-sign"><span style=" margin-left: 10px">是否删除该数据？</span></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="truedel()">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
        <!--多选删除模态框-->
        <div class="modal fade" id="dellalltModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">提示：</h4>
                    </div>
                    <div class="modal-body text-center">
                        <span style="font-size: 18px;" class="text-red glyphicon glyphicon-exclamation-sign"><span style="margin-left: 10px">是否删除选中数据？</span></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="dodel()" class="btn btn-primary">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>
<script type="text/javascript">
    //全选反选
    $("#checkbox").click(function () {
                $("input:checkbox").prop("checked", $("#checkbox").prop('checked'));
            }
    );
    $("input[name='checkbox[]']").click(
            function () {
                if ($('input[name="checkbox[]"]:checked').length == $('input[name="checkbox[]"]').length) {
                    $("#checkbox").prop("checked", true);
                } else {
                    $("#checkbox").prop("checked", false);
                }
            });
    var delid ="";      //全局变量:需要删除数据的id
    //删除弹框
    function del(id) {
        delid = id;
        $("#delModal").modal();
        return fasle;
    }
    //确认删除操作
    function truedel() {
        location.href = "<?php echo U('comment/comment_del');?>&id="+delid;
    }
    //多选删除弹框
    function dellAll() {
        $("#dellalltModal").modal()
    }
    //多选删除操作
    function dodel(){
        delform.submit();
    }
    //审核弹框
    function audit(id,status) {
        $("#auditModal").modal({});
        $("#auditid").val(id);
        $("input[value="+status+"]").prop("checked",true);
    }

    //下拉框筛选审核状态
    $("#audit option").click(
            function () {
                var sta = $(this).val();
                if(sta =="all"){
                    location.href = "<?php echo U('comment/index');?>";
                }else {
                    location.href = "<?php echo U('comment/audit');?>&status=" + sta;
                }
            }
    );
    //根据审核筛选，，下拉框默认选中
    $(function(){
        var audit = "<?php echo ($_GET['status']); ?>";
        if(audit == "pending"){
            $("#audit option[value='pending']").attr("selected","selected")
        }
        if(audit == "reject"){
            $("#audit option[value='reject']").attr("selected","selected")
        }
        if(audit == "success"){
            $("#audit option[value='success']").attr("selected","selected")
        }
    });
    //判断搜索框的输入内容是否为空
    function select() {
        var val = $("#select").val();
        var vals = $.trim(val);
        if(vals == ""){
            location.href = "<?php echo U('comment/index');?>";
            return false;
        }
    }
    //显示未审核数量
    $(function(){
        var num = "<?php echo $num ?>";
        if(num == 0){
            $("span:contains('评论管理')").after("");
        } else {
            var text = "<small class='label pull-right bg-green'>"+num+"条</small>";
            $("span:contains('评论管理')").after(text)
        }
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