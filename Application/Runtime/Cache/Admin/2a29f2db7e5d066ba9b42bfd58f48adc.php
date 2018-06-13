<?php if (!defined('THINK_PATH')) exit();?>
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
<?php
 $route = 'user/' . $type; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo ($page_title); ?><small></small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>首页</a></li>
        <li class="active"><?php echo ($page_title); ?></li>
    </ol>
</section>
        <!--主题内容-->
        <section class="content">
            <!--表格-->
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="pull-left">
                                <a href="<?php echo U($route,array('id'=>$val[id],'operation'=>'add_user'));?>" class="btn btn-primary pull-left w100">添加用户</a>
                            </div>
                            <form action="<?php echo U($route,array('operation'=>'user_search'));?>" method="post">
                            <div class="pull-right">
                                <label>过滤：</label>
                                <div class="inline-block" id="region">
                                    <select class="form-control w150 inline-block province" id="province_id" name="province_id">
                                        <option value="">≡ 请选择省 ≡</option>
                                    </select>
                                    <select class="form-control w150 inline-block city" id="city_id" name="city_id">
                                        <option value="">≡ 请选择市 ≡</option>
                                    </select>
                                    <select class="form-control w150 inline-block district" id="district_id" name="district_id">
                                        <option value="">≡ 请选择区 ≡</option>
                                    </select>
                                    <select name="level" id="level" class="form-control w150 inline-block">
                                        <option value="">≡ 等级 ≡</option>
                                        <?php if(is_array($level_data)): $i = 0; $__LIST__ = $level_data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                                <input type="text" placeholder="搜索..." class="form-control w150 inline-block" id="search" name="search">
                                <button class="btn btn-default" onclick="return myform()"><i class="fa fa-search inline-block"></i></button>
                            </div>
                            </form>
                        </div><!-- /.box-header -->

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover text-center">
                                <tbody>
                                <tr>
                                    <th width="10%">注册时间</th>
                                    <th width="8%">用户名</th>
                                    <th width="8%">姓名</th>
                                    <th width="8%">电话</th>
                                    <th width="8%">角色</th>
                                    <th width="8%">余额</th>
                                    <th width="8%">积分</th>
                                    <th width="8%">级别</th>
                                    <th width="8%">实名认证</th>
                                    <th width="20%">管理</th>
                                </tr>
                                <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                                    <td><?php echo ($val["add_time"]); ?></td>
                                    <td><?php echo ($val["name"]); ?></td>
                                    <td><?php echo ($val["real_name"]); ?></td>
                                    <td><?php echo ($val["tel"]); ?></td>
                                    <td>
                                        <?php if($val["user_type"] == province_agent): ?>省代理
                                            <?php elseif($val["user_type"] == district_agent ): ?>区代理
                                            <?php elseif($val["user_type"] == city_agent): ?>市代理
                                            <?php elseif($val["user_type"] == fan): ?>粉丝
                                            <?php elseif($val["user_type"] == partner): ?>合作商家
                                            <?php else: ?>T会员<?php endif; ?>
                                    </td>
                                    <td><?php echo ($val["money"]); ?></td>
                                    <td><?php echo ($val["integral"]); ?></td>
                                    <td><?php echo ($val["level_name"]); ?></td>
                                    <td>
                                        <?php if($val["is_validated"] == no): ?><small class="label bg-red">否</small>
                                            <?php elseif($val["is_validated"] == yes): ?><small class="label bg-green">是</small>
                                            <?php elseif($val["is_validated"] == pending): ?><small class="label bg-gray">待审核</small><?php endif; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#view_details" onclick="view_details('<?php echo ($val["id"]); ?>')">查看详情</a>
                                        <a href="<?php echo U($route,array('id'=>$val[id],'operation'=>'look_team'));?>" style="margin-top: 3px;" class="btn btn-default btn-sm">查看团队</a>
                                        <a href="<?php echo U($route,array('id'=>$val[id],'operation'=>'look_fans'));?>" style="margin-top: 3px;" class="btn btn-default btn-sm">查看粉丝</a>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="addnotice('<?php echo ($val["id"]); ?>','<?php echo ($val["name"]); ?>')">发信息</a>
                                        <a href="<?php echo U($route,array('id'=>$val[id],'operation'=>'look_capital'));?>" class="btn btn-default btn-sm">资金明细</a>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="addfans('<?php echo ($val["id"]); ?>')">添加粉丝位</a>
                                        <a href="<?php echo U($route,array('id'=>$val[id],'operation'=>'edit'));?>" style="margin-top: 3px;" class="btn btn-default btn-sm">编辑</a>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="sh('<?php echo ($val["id"]); ?>',this)">审核</a>
                                        <a href="javascript:void(0)" style="margin-top: 3px;" type="button" class="btn btn-default btn-sm" onclick="del('<?php echo ($val["id"]); ?>')">删除</a>
                                    </td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-5"></div>
                                <div class=" col-sm-7 ">
                                    <div class="text-right">
                                       <ul class="pagination">
                                           <?php echo ($page); ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>
        <!--查看详情-->
        <div class="modal fade" id="view_details">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">基本信息</h4>
                    </div>
                    <div class="modal-body" style="padding-top: 0px;">
                        <table class="table table-hover">

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default w100" data-dismiss="modal">关闭</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--添加粉丝位-->
        <div class="modal fade" id="addfans">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">添加粉丝</h4>
                    </div>
                    <div class="modal-body text-center">
                        <form name="addfans_form" action="<?php echo U('user/addfans');?>" method="post" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label" style="font-size: 18px; padding-right: 0px;">新增粉丝位：</label>
                                <div class="col-sm-9">
                                    <input type="text" name="fans" class="form-control w150">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <span><i>备注：新增粉丝位限当月使用</i></span>
                            </div>
                            <input type="hidden" name="id" id="user_id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w100 ">确定</button>
                        <button type="button" class="btn btn-default w100 " data-dismiss="modal">取消</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!--删除-->
        <div class="modal fade" id="del">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">提示</h4>
                    </div>
                    <div class="modal-body">
                        <span class="glyphicon glyphicon-question-sign fa-2x text-red" style="font-size: 18px" ></span><span style="margin-left: 10px;font-size: 18px;color: red;">确认要删除选择的数据</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary w100">确定</button>
                        <button type="button" class="btn btn-default w100" data-dismiss="modal">取消</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
            <!-- 审核模态框 -->
            <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">审核：</h4>
                        </div>
                        <div class="modal-body text-center">
                            <label class="radio-inline">
                                <input type="radio" id="review_no" name="review" value="no">审核不通过
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="review_pending" name="review" value="pending">待审核
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="review_yes" name="review" value="yes">审核通过
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">确定</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--发公告模态框-->
            <div class="modal fade" id="addnotice">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">发公告</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row form-group" id="noticemessage">
                                    <div class="col-md-12">
                                        <label>公告内容：</label>
                                        <textarea id="message" name="message" class="form-control" rows="6" placeholder="" style="width:500px;margin: auto;"></textarea>
                                        <label class="control-label messagehint hide">
                                             <i class="fa fa-times-circle-o"></i>
                                             公告内容不能为空
                                        </label>
                                     </div>
                                </div>

                                <div class="row form-group" id="receive">
                                    <div class="col-md-12">
                                        <label style="margin-top: 20px;">接收人：</label>
                                        <span></span>
                                        <input type="hidden" name="author" value="one">
                                        <input type="hidden" name="userid" value="">
                                    </div>
                                  </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary w100" onclick="return notice()">确定</button>
                                <button type="button" class="btn btn-default w100" data-dismiss="modal">取消</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </section><!-- /.content -->
</div>

<!--省市区三级联动-->
<script src="<?php echo ASSETS;?>plugins/jquery.cityselect.js" type="text/javascript"></script>

<script type="text/javascript">
    //搜索内容返回
    var province_id = "<?php echo ($province_id); ?>";
    var city_id = "<?php echo ($city_id); ?>";
    var district_id = "<?php echo ($district_id); ?>";
    var level = "<?php echo ($level); ?>";
    var search = "<?php echo ($search); ?>";
    $("#search").val(search);
    if(level != ""){
        $("#level option[value="+level+"]").prop("selected",true);
    }
    //待审核人数
    var num = <?php echo ($no_num); ?>;
    var user_type_01 = "";
    var user_type = "<?php echo ($type); ?>";
    if(user_type == "province_agent"){
        user_type_01 = "省代理";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }else if(user_type == "city_agent"){
        user_type_01 = "市代理";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }else if(user_type == "district_agent"){
        user_type_01 = "区代理";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }else if(user_type == "member"){
        user_type_01 = "T会员";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }else if(user_type == "partner"){
        user_type_01 = "合作商家";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }else if(user_type == "fan"){
        user_type_01 = "粉丝";
        if(num != 0) {
            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">' + num + '位</small>');
        }
    }
    //省市区三级联动
    $(function () {
        //省市区三级联动
        //注意三级联动结构：#region(自定义) > .province + .city + .district
        var obj = {
            nodata: "none",
            required: false,
            province:null, //"河南省"
            city: null,
            district: null,
            url: "<?php echo U('admin/user/getCity');?>"
        };

        function pdc(p,d,c) {
            if(p ==""){
                p=null;
            }
            if(d ==""){
                d=null;
            }
            if(c == ""){
                c = null;
            }
            obj['province'] = p;
            obj['district'] = d;
            obj['city'] = c;
        }
        pdc(province_id,district_id,city_id);
        $("#region").citySelect(obj);

    });

    //查看详情
    function view_details(id) {
        var url = "<?php echo U('user/view_details');?>";
        $.get(url,{id:id},function (data) {
            //获取团队数与数据的分割位置
            var wz = data.indexOf("[");
            //拥有团队数量
            var team_sum = data.substr(0,wz);
            //数据
            var record = data.substr(wz);
            var json = JSON.parse(record);
            //存放数据容器
            var container = "";
            //角色
            var role = "";
            //是否实名认证
            var is_validated = "";
            //性别
            var sex = "";
            //操作数据
            for(var key in json) {
                var row = json[key];

                if(row.user_type == "province_agent"){
                    role = "省代理";
                }else if(row.user_type == "district_agent"){
                    role = "区代理";
                }else if(row.user_type == "city_agent"){
                    role = "市代理";
                }else if(row.user_type == "fan"){
                    role = "粉丝";
                }else if(row.user_type == "partner"){
                    role = "合作商家";
                }else {
                    role = "T会员";
                }

                if(row.is_validated == "yes"){
                    is_validated = "是";
                }else if(row.is_validated == "no"){
                    is_validated = "否";
                }else{
                    is_validated = "待审核";
                }

                if(row.sex == "man"){
                    sex = "男";
                }else if(row.sex == "female"){
                    sex = "女";
                }else{
                    sex = "保密";
                }
                container+='<tr> <td width="40%" class="text-right">姓名：</td><td width="60%" class="text-left">'+row.name+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">性别：</td><td width="60%" class="text-left">'+sex+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">年龄：</td><td width="60%" class="text-left">'+row.age+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">电话：</td><td width="60%" class="text-left">'+row.tel +'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">是否实名认证：</td><td width="60%" class="text-left">'+is_validated+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">身份证：</td><td width="60%" class="text-left">'+row.identity+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">角色：</td><td width="60%" class="text-left">'+role+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">余额：</td><td width="60%" class="text-left">'+row.money+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">积分：</td><td width="60%" class="text-left">'+row.integral+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">拥有团队数：</td><td width="60%" class="text-left">'+team_sum+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">推荐粉丝数：</td><td width="60%" class="text-left">'+row.fans+'</td></tr>';
                container+='<tr> <td width="40%" class="text-right">地址：</td><td width="60%" class="text-left">'+row.address+'</td></tr>';
            }
            $("#view_details table").html(container);
        })
    }

    //删除
    function del(id) {
        $("#del").modal({});
        $("#del button:contains('确定')").click(function () {
            location.href = "<?php echo U('user/del');?>&id="+id;
        })
    }

    //审核模态框
    function sh(id, a) {
        var type = $(a).parent().prev().children().html();
         if(type == "是"){
            $("#review_yes").prop("checked",true);
         }else if(type == "否"){
             $("#review_no").prop("checked",true);
         }else if(type == "待审核"){
             $("#review_pending").prop("checked",true);
         }
        $("#review").modal({});
        $("#review button:contains('确定')").one('click', function () {
            var val = $("#review input:checked").val();
            var url = "<?php echo U('user/review');?>";
            $.get(url, {id: id, review: val}, function (data) {
                console.log(data);
                if (val == "yes") {
                    var before_type = $(a).parent().prev().children().html();
                    if (before_type == "待审核") {
                        var num = $("span:contains(" + user_type_01 + ")").next().text();
                        num = num.substr(0, num.length - 1);
                        num = num - 1;
                        if (num == 0) {
                            $("span:contains(" + user_type_01 + ")").next().text("");
                        } else {
                            $("span:contains(" + user_type_01 + ")").next().text(num + "位");
                        }
                    }
                    $(a).parent().prev().html('<small class="label bg-green">是</small>');
                    $("#review").modal("hide");
                } else if (val == "no") {
                    var before_type = $(a).parent().prev().children().html();
                    if (before_type == "待审核") {
                        var num = $("span:contains(" + user_type_01 + ")").next().text();
                        num = num.substr(0, num.length - 1);
                        num = num - 1;
                        if (num == 0) {
                            $("span:contains(" + user_type_01 + ")").next().text("");
                        } else {
                            $("span:contains(" + user_type_01 + ")").next().text(num + "位");
                        }
                    }
                    $(a).parent().prev().html('<small class="label bg-red">否</small>');
                    $("#review").modal("hide");
                } else if (val == "pending") {
                    var before_type = $(a).parent().prev().children().html();
                    if (before_type != "待审核") {
                        var num = $("span:contains(" + user_type_01 + ")").next().text();
                        if (num == "") {
                            $("span:contains("+user_type_01+")").after('<small class="label pull-right bg-green">1位</small>');
                        } else {
                            num = num.substr(0, num.length - 1);
                            num = parseInt(num) + 1;
                            $("span:contains(" + user_type_01 + ")").next().text(num + "位");
                        }
                    }
                    $(a).parent().prev().html('<small class="label bg-gray">待审核</small>');
                    $("#review").modal("hide");
                }
            })
        })
    }

    //审核表单操作

    //添加粉丝
    function addfans(id) {
        $("#addfans").modal({});
        $("#user_id").val(id);
        $("#addfans button:contains('确定')").click(function () {
            addfans_form.submit();
        })
    }

    //搜索条件判断
    function myform() {
        var province = $.trim($("#province_id").val());
        var district = $.trim($("#district_id").val());
        var city = $.trim($('#city_id').val());
        var level = $.trim($("#level").val());
        var search_ =$.trim($("#search").val());
        if(province == "" && district == "" && city =="" && search_ =="" && level == ""){
            alert("请输入搜索条件");
            return false;
        }else {
            return true;
        }
    }

	//为某个用户增添公告
    function addnotice(id,name){
        $('#addnotice').modal();
        $('[name=userid]').val(id);
        $('#receive span').text(name);
        //失去焦点报错，获取焦点错误消失
        $('#message').bind('blur',function () {
            if ($.trim($('#message').val())=='') {
                $('#noticemessage').addClass('has-error');
                $('.messagehint').removeClass('hide');
            }
        });
        $('#message').bind('focus',function () {
            $('#noticemessage').removeClass('has-error');
            $('.messagehint').addClass('hide');
        });
    }
    //提交
    function notice () {
        if($.trim($('#message').val())==''){
            $('#message').focus();
            return false;
        }else{
            var userid = $('[name=userid]').val();          //用户id
            var message = $('#message').val();              //向用户发送的消息
            var author = $('[name=author]').val();          //保存用户类型
            //保存地址
            var url = "<?php echo U('notice/add');?>";
            $.post(url,{userid:userid,message:message,author:author},function(e){
                $('#addnotice').modal('hide');
                alert(e.info);
            })
        }

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