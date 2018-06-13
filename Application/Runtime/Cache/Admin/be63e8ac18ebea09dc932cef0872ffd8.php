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
    <!-- jquery file upload -->
    <script>
        function upload(b) {
            $('#myModal').modal({});
            var ONE
            var ONE = new XMLHttpRequest();
            var url="<?php echo U('finance/tankuang');?>&id="+b;
            $.getJSON(url,function (json) { 
                 var tbody='';
                 var remark=json[0].remark;
                 if(remark){}else{
                 remark="占无备注";
                 }
                 var tel=json[0].tel;
                 if(tel){}else{
                     tel="占无联系方式";
                 }
                 var level_name=json[0].level_name;
                 if(level_name){}else{
                     level_name="";
                 }
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">用户名：</p></td>';
                 tbody+='<td class="tc" width="70%"><p class="pull-left">'+json[0].user_name+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">电话：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+tel+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">用户角色：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+level_name+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">金额：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+json[0].money+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">状态：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+json[0].status+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">类型：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+json[0].do_type+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">时间：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+json[0].add_time+'</p></td>';
                 tbody+='</tr>';
                 tbody+='<tr>';
                 tbody+='<td><p class="pull-right">备注：</p></td>';
                 tbody+='<td class="tc"><p class="pull-left">'+remark+'</p></td>';
                 tbody+='</tr>';

                 document.getElementById("tbody").innerHTML=tbody;
            })
            /*ONE.open("POST", url);
            ONE.send();
            ONE.onreadystatechange = function() {
                if (ONE.readyState == 4 && ONE.status == 200 ) {
                    var data = ONE.responseText;
                    var a=JSON.parse(data);//转换成json
                    var tbody='';
                    for (var k in a) {
                        var row=a[k];
                        var remark=row.remark;
                        if(remark){}else{
                            remark="占无备注";
                        }
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">用户名：</p></td>';
                        tbody+='<td class="tc" width="70%"><p class="pull-left">'+row.user_name+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">电话：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.tel+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">用户角色：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.level_name+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">金额：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.money+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">状态：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.status+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">类型：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.do_type+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">时间：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+row.add_time+'</p></td>';
                        tbody+='</tr>';
                        tbody+='<tr>';
                        tbody+='<td><p class="pull-right">备注：</p></td>';
                        tbody+='<td class="tc"><p class="pull-left">'+remark+'</p></td>';
                        tbody+='</tr>';
                    }
                    document.getElementById("tbody").innerHTML=tbody;
                }
            }*/
            return false;
        }
        function sour() {
            var del
            var del = new XMLHttpRequest();
            var s1=$("#no1").val();
            var s2=$("#no2").val();
            var s3=$("#no3").val();
            var s4=$("#no4").val();

                self.location ='admin.php?m=Admin&c=finance&a=index&so1='+s1+'&so2='+s2+'&so3='+s3+'&so4='+s4;

        }
        //审核
        function shenhe(id,status) {
            $("#auditModal").modal({});
            $("#auditid").val(id);
            $("input[value="+status+"]").prop("checked",true);
        }
        function ok() {
            var auditid=$("#auditid").val();
            var status=$('.audit:checked').val();
            var url= "<?php echo U('finance/shenhe');?>&auditid="+auditid+'&status='+status;
            $.getJSON(url,function (json){
                if(json=='成功'){
                    $("#"+auditid+"").text(status);
                    var b=$("#"+auditid+"").text();
                    if (b=='拒绝'){
                        $("#"+auditid+"").removeClass('bg-red bg-primary bg-gray');
                        $("#"+auditid+"").addClass('bg-black');
                    }
                    if (b=='撤销'){
                        $("#"+auditid+"").removeClass('bg-black bg-primary bg-gray');
                        $("#"+auditid+"").addClass('bg-red');
                    }
                    if (b=='已审核') {
                        $("#"+auditid+"").removeClass('bg-black bg-red bg-gray');
                        $("#"+auditid+"").addClass('bg-primary');
                    }
                    if (b=='待审核'){
                        $("#"+auditid+"").removeClass('bg-black bg-red bg-primary');
                        $("#"+auditid+"").addClass('bg-gray');
                    }
                }else{
                    alert('失败')
                }

            })
        }
        function selectDate(o, id) {
            var _id = '#' + id;
            $(_id).datepicker({
                format: 'yyyy',
                language: 'zh-CN'
            }).on("changeDate", function(e) {
                var me = e.target;
                $(this).datepicker('hide');
            });

            $(_id).datepicker('show');

        }
        $(document).ready(
                function () {
                    var nowpage=$("#nowpage").val();
                    var zy=$("#zongpage").val();
                    $("#"+nowpage+"").addClass('active');
                    if (nowpage==1){
                        $("#example2_previous").addClass('disabled');
                    }
                    if(nowpage==zy){
                        $("#example2_next").addClass('disabled');
                    }
                    var a=$(".sm").length-1;;
                    var i=0;
                    for (i;i<=a;i++){
                        var zt=$(".sm").eq(i).text();
                        if (zt=='拒绝'){
                            $(".sm").eq(i).addClass('bg-black');
                        }
                        if (zt=='撤销'){
                            $(".sm").eq(i).addClass('bg-red');
                        }
                        if (zt=='已审核'){
                            $(".sm").eq(i).addClass('bg-primary');
                        }
                        if (zt=='待审核'){
                            $(".sm").eq(i).addClass('bg-gray');
                        }
                    }



                }
        )
    </script>

    <!--左侧边栏-->
    <!-- Left side column. contains the logo and sidebar -->
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
                        <div class="pull-left row" style="margin-left:10px">
                            <button class="btn btn-primary pull-right">导出EXCEL</button>
                        </div>
                        <div class="select pull-right">
                            <div style="width:250px; margin-left: 5px; " class="input-group">
                                <input type="text" id="no4" placeholder="" style="" class="form-control  " name="">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" onclick="return sour()"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right form-inline">
                            <span>过滤条件：</span>
                            <select  class="form-control" id="no1">
                                <option>所有角色</option>
                                <?php if(is_array($level)): foreach($level as $key=>$data): ?><option><?php echo ($data["name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                            <select  class="form-control" id="no2">
                                <option>所有类型</option>
                                <?php if(is_array($type)): foreach($type as $key=>$data): ?><option><?php echo ($data); ?></option><?php endforeach; endif; ?>
                            </select>
                            <div class="input-group">
                                <select  class="form-control" id="no3">
                                    <option>所有年份</option>
                                    <?php for($i=date("Y",time());$i>=1600;$i--){ echo "<option>".$i."</option>"; } ?>
                                </select>
                                <!-- <em class="help-block"></em> -->
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th width="14%">用户名</th>
                                <th width="18%">等级</th>
                                <th width="10%">金额</th>
                                <th width="11%">业务类型</th>
                                <th width="18%">时间</th>
                                <th width="14%">状态</th>
                                <th width="15%">管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(is_array($user)): foreach($user as $key=>$data): ?><tr>
                                        <td><?php echo ($data["user_name"]); ?></td>
                                        <td><?php echo ($data["level_name"]); ?></td>
                                        <td><?php echo ($data["money"]); ?></td>
                                        <td><?php echo ($data["do_type"]); ?></td>
                                        <td><?php echo ($data["add_time"]); ?> </td>
                                        <td><small class="label sm" id="<?php echo ($data["id"]); ?>"><?php echo ($data["status"]); ?></small></td>
                                        <td><button class="btn btn-default btn-xs but" type="button" onclick="return upload('<?php echo ($data["id"]); ?>')">查看详情</button>
                                            <button class="btn btn-default btn-xs but" type="button" onclick="return shenhe('<?php echo ($data["id"]); ?>','<?php echo ($data["status"]); ?>')">审核</button></td>
                                    </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer">
                        <div class="text-right">
                            <input id="nowpage" style="display: none" value="<?php echo ($page); ?>">
                            <input id="zongpage" style="display: none" value="<?php echo ($zy); ?>">
                            <ul class="pagination">
                                <li id="example2_previous" class="paginate_button previous"><?php echo ($prev); ?></li>
                                <?php if(is_array($allpage)): foreach($allpage as $key=>$data): echo ($data); endforeach; endif; ?>
                                <li id="example2_next" class="paginate_button next"><?php echo ($next); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 审核模态框 -->
        <div class="modal fade" id="auditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                        <h4 class="modal-title">审核：</h4>
                    </div>
                    <div class="modal-body text-center">
                        <label class="radio-inline">
                            <input type="radio" class="audit" name="audit" value="待审核"> 待审核
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="audit" name="audit" value="拒绝"> 未通过
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="audit" name="audit" value="已审核"> 审核通过
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="audit" name="audit" value="撤销"> 撤销
                        </label>
                        <input type="hidden" id="auditid"  name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="return ok()" data-dismiss="modal">确定</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- /.content -->
</div><!-- /.content-wrapper -->
<!-- 详情模态框 -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">资金明细</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <table class="table table-hover">
                    <tbody id="tbody">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="pull-right" style="">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">关闭</span></button>
                </div>
            </div>
        </div>
    </div>
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