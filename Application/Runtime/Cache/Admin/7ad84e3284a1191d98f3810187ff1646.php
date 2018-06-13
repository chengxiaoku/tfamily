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
        .label_mess{
            width: 100px;
            text-align: right;
            margin-right: 15px;
        }
        .house_img{
            background-color: #cfcfcf;
            padding: 10px;
        }
        .img_1{
            width: 100px;
            height: 100px;
        }
        .text{
            margin-left: 50px;
        }
        .del{
            position: relative;
            top: 35px;
        }
        .new_div{
            border: 2px #888888 double; padding: 15px; margin-top: 15px;
        }


    </style>
    <!-- 主体内容 -->
    <form method="post" name="form1" id="myform" action="<?php echo U('House/add_house_sql');?>" enctype="multipart/form-data">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-9">

                <div class="nav-tabs-custom" id="bod">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">基本信息</a></li>
                        <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">户型</a></li>
                        <li ><a href="#tab_3" data-toggle="tab" aria-expanded="false">楼盘相册</a></li>
                        <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">其他信息</a></li>
                    </ul>
                    <!--基本信息-->
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="form-group">
                                <label for="" class="label_mess">楼盘名称：<span class="required">*</span></label>
                                <input type="text" name="house_name" placeholder="输入楼盘名称 ..." class="form-control wp50 inline-block" >
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess">楼盘简介：<span class="required">*</span></label>
                                <input type="text" name="house_mess" placeholder="输入楼盘简介 ..." class="form-control wp50 inline-block" >
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess">物业类型：<span class="required">*</span></label>
                                <select name="lx" class="form-control" style="width: 300px; display: inline">
                                    <?php foreach($wy_type as $key=>$val) : ?>
                                    <option value="<?php echo ($key); ?>"><?php echo ($val); ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess">参考价格：<span class="required">*</span></label>
                                <input type="text" name="house_money" style="width: 90px;" placeholder="输入参考价格..." class="form-control wp50 inline-block" ><span id="mon">元/平米</span>
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess" style="position: relative;top: -130px;">项目特色：</label>
                                <textarea name="ts" style="width: 400px; height: 150px;"></textarea>
                            </div>

                            <div class="form-group">
                            <div class="row" >
                                <div class="col-md-2">
                                    <label for="" class="label_mess"  >区域地址：</label>
                                </div>
                                <div class="col-md-10">
                                    <div id="region">
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
                                    </div>
                                </div>
                            </div>

                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">楼盘地址：</label>
                                <input name="house_adress" type="text" placeholder="输入楼盘地址..." class="form-control wp50 inline-block" >
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess">售楼处地址：</label>
                                <input name="sl_adress" type="text" placeholder="输入售楼处地址..." class="form-control wp50 inline-block" >
                            </div>
                            <div class="form-group">
                                <label for="" class="label_mess">开发商：</label>
                                <input name="developer" type="text" placeholder="输入开发商..." class="form-control wp50 inline-block" >
                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">最大面积：</label>
                                <input name="max_area" type="text" placeholder="输入最大面积..." class="form-control wp50 inline-block" >
                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">最小面积：</label>
                                <input name="min_area" type="text" placeholder="输入最小面积..." class="form-control wp50 inline-block" >
                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">促销信息：</label>
                                <input name="promotion_msg" type="text" placeholder="输入最小面积..." class="form-control wp50 inline-block" >
                                <b>如:30万抵50万</b>
                            </div>

                            <div class="form-group">
                                <label class="label_mess inline-block">是否热门:</label>
                                <div id="is_hot" class="inline-block">
                                    <label class="radio-inline"><input type="radio" checked  class=""  value="1" name="is_hot">是</label>
                                    <label class="radio-inline"><input type="radio"  class="" value="0" name="is_hot">否</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="label_mess inline-block">是否推荐:</label>
                                <div id="is_recommended" class="inline-block">
                                    <label class="radio-inline"><input type="radio" checked  class=""  value="1" name="is_recommended">是</label>
                                    <label class="radio-inline"><input type="radio"  class="" value="0" name="is_recommended">否</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="label_mess inline-block">状态:</label>
                                <div id="is_sale" class="inline-block">
                                    <label class="radio-inline"><input type="radio" checked   value="yes" name="is_sale">在售</label>
                                    <label class="radio-inline"><input type="radio"  value="no" name="is_sale">售完</label>
                                    <label class="radio-inline"><input type="radio"  value="pending" name="is_sale">待售</label>
                                    <label class="radio-inline"><input type="radio"  value="all" name="is_sale">不限</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">缩略图：</label>
                                <div class="input-group" style="position: relative; left: 120px; top: -30px;">
                                   <input type="text" placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput1" data-thumb="">
                                    <input type="hidden" id="jb_image" name="jb_image" >
                                        <button onclick="upload1()" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                                </div>

                            </div>
                        </div><!-- /.tab-pane -->

                        <!--户型-->

                        <div class="tab-pane" id="tab_2">
                            <div style="display: none;">
                              <div class="new_div" id="house_type_template">
                                <div class="form-group">
                                    <label for="" class="label_mess">户型名称：</label>
                                    <span class="hx"></span>
                                    <input  name="hx[]" type="hidden">
                                    <span class="hx_del" onmouseover="cc(this)" onmouseout="c1(this)" onclick="c2(this)" style="float: right; cursor: pointer; font-size: 26px; position: relative; top: -10px;">×</span>
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_mess">户型朝向：</label>
                                    <span class="hx_cx" ></span>
                                    <input  name="hx_cx[]" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_mess">居室：</label>
                                    <span class="hx_type" ></span>
                                    <input  name="hx_type_s[]" type="hidden">
                                    <input  name="hx_type_t[]" type="hidden">
                                    <input  name="hx_type_w[]" type="hidden">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label_mess">建筑面积：</label>
                                    <span class="hx_mj" ></span>
                                    <input name="hx_mj[]" type="hidden">
                                    <!--<input type="hidden" name="house[type][area][]" value="">-->
                                </div>

                                  <div class="form-group">
                                      <label for="" class="label_mess">缩略图：</label>
                                      <img src="" class="thumb">
                                      <input type="hidden" name="thumb[]" class="hide_thumb" value="">
                                  </div>

                              </div>
                            </div>
                            <div id="new_cont"></div>
                            <input type="button" class="btn btn-success w150" style="margin-left: 210px; margin-top: 30px;" id="insert" value="添加户型">

                        </div><!-- /.tab-pane -->

                        <!--楼盘相册-->
                        <div class="tab-pane" id="tab_3">
                            <div style="display: none;">
                            <div class="form-group house_img div_yc" >
                                <div class="div_1">
                                    <img src="" class="thumb1" >
                                    <img src="" class="thumb2" >
                                    <img src="" class="thumb3" >
                                    <img src="" class="thumb4">
                                    <input type="hidden"  name="lp_thumb[]" class="hide_thumb1" value="">
                                    <input type="hidden"  name="lp_thumb[]" class="hide_thumb1_1" value="">
                                    <input type="hidden"  name="lp_thumb[]" class="hide_thumb1_2" value="">
                                    <input type="hidden"  name="lp_thumb[]" class="hide_thumb1_3" value="">
                                    <span style="margin-left: 30px; font-size: 18px;" id="lp_text"></span>
                                    <input type="hidden" name="lp_text[]">
                                    <button type="button" class="btn btn-danger pull-right del " onclick="return yc(this)">移除</button>
                                </div>
                            </div>
                            </div>
                            <div id="insert_img_new"></div>
                            <input type="button" class="btn btn-success w150" style="margin-left: 210px; margin-top: 30px;" id="inser_img" value="添加相册">
                        </div><!-- /.tab-pane -->
                        <!--其他信息-->
                        <div class="tab-pane" id="tab_4">
                            <div class="form-group">
                                <label for="" class="label_mess">建筑类型：</label>
                                <select class="form-control" style="width: 300px; display: inline" name="jz_type">
                                    <?php foreach($lp_type as $key=>$val) : ?>
                                    <option value="<?php echo ($key); ?>"><?php echo ($val); ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="form-group">
                            <div style="margin-left: 45px;">
                                <label style="position: relative;top: -11px; left: -15px;" class="inline-block">开盘时间：</label>
                                <div class="inline-block">
                                    <div class="input-group">
                                        <input type="text" name="zj" placeholder="输入最新开盘时间 ..." id="begin-time" class="form-control">
                                        <div class="input-group-btn">
                                            <button onclick="return selectDate(this, 'begin-time')" type="button" class="btn btn-success btn-flat"><i class="fa fa-clock-o"></i><tton>
                                        </div>
                                    </div>
                                    <!-- <em class="help-block"></em> -->
                                </div>
                            </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="label_mess">产权年限：</label>
                                <input type="text" name="cq" placeholder="输入产权年限 ..." class="form-control wp50 inline-block" >
                            </div>
                        </div>
                    </div><!-- /.tab-content -->
                </div>
                <div>
                    <input type="button" class="btn btn-primary w200" value="保存" onclick="sumi()">
                </div>
            </div>


        </div>
    </section><!-- /.content -->



    <!-- 添加户型 -->
    <div class="modal fade" id="myhintModal" style="margin-top: 80px;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myMdalLabel">添加户型</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="label_mess">户型名称：<span class="required">*</span></label>
                        <input id="hx1" type="text" placeholder="输入 户型名称..." class="form-control wp50 inline-block" >
                    </div>
                    <div class="form-group">
                        <label class="label_mess">户型朝向：</label>
                    <span>
                        <input type="checkbox" class="hx_cx"><span  style="margin-right: 20px;">东</span>
                        <input type="checkbox" class="hx_cx"><span  style="margin-right: 20px;">南</span>
                        <input type="checkbox" class="hx_cx"><span  style="margin-right: 20px;">西</span>
                        <input type="checkbox" class="hx_cx"><span style="margin-right: 20px;">北</span>
                        <span id="dx"></span>
                    </span>
                    </div>
                    <div class="form-group">
                        <label class="label_mess">建筑面积：<span class="required">*</span></label>
                        <input type="text" id="hx_j" placeholder="输入面积..." class="form-control wp50 inline-block" >
                    </div>
                    <div class="form-group">
                        <label class="label_mess">居室：<span class="required">*</span></label>
                        <input type="text" id="hx_s" style="width: 30px;">室
                        <input type="text" id="hx_t" style="width: 30px;">厅
                        <input type="text" id="hx_w" style="width: 30px;">卫
                        <span id="hx_me"></span>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="" class="label_mess">缩略图：</label>
                            <div class="input-group" style="position: relative; left: 120px; top: -30px;">
                                <input type="text" name="image" placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput" data-thumb="">
                                    <button onclick="upload()" style="" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="submt">确定</button>
                </div>
            </div>
        </div>
    </div>

    <!--楼盘相册的添加-->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">添加楼盘相册</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label  class="label_mess">楼盘相册名称：</label>
                        <input type="text" id="kf" placeholder="输入楼盘相册名称..." class="form-control wp50 inline-block" >
                        <span style="font-size: 14px; color: red;"></span>
                    </div>
                    <div class="form-group">
                        <label class="label_mess">缩略图1：</label>
                        <div class="input-group" style="position: relative; left: 120px; top: -30px;">

                                <input type="text"  placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput3" data-thumb="">
                                <button onclick="upload3()" style="" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label_mess">缩略图2：</label>
                        <div class="input-group" style="position: relative; left: 120px; top: -30px;">

                            <input type="text"  placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput3_1" data-thumb="">
                            <button onclick="upload3_1()" style="" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label_mess">缩略图3：</label>
                        <div class="input-group" style="position: relative; left: 120px; top: -30px;">

                            <input type="text" placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput3_2" data-thumb="">
                            <button onclick="upload3_2()" style="" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label_mess">缩略图4：</label>
                        <div class="input-group" style="position: relative; left: 120px; top: -30px;">

                            <input type="text" placeholder="上传缩略图 ..." style="width: 150px;"  class="form-control" id="uiFileUploadInput3_3" data-thumb="">
                            <button onclick="upload3_3()" style="" type="button" class="btn btn-success btn-flat"><i class="fa fw fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="ok_insert_img">确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--上传图片-->

    <!--楼盘相册移除-->
    <div class="modal fade" id="myModall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">移除操作</h4>
                </div>
                <div class="modal-body">
                    <h5 style="color: red;"><span class="glyphicon glyphicon-exclamation-sign" style="margin-right:10px; "></span>是否移除?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="img_yc"> 确认</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </form>
    <!-- /.content  -->

</div>

<!--户型模板-->



<!-- 上传图片模态框 -->
<div class="modal fade " id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>


<!-- 上传图片模态框 基本信息 -->
<div class="modal fade " id="imageUploadModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload1" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput1">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal" ">保存</button>
            </div>
        </div>
    </div>
</div>
<!-- 上传图片模态框添加相册 -->
<div class="modal fade " id="imageUploadModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload3" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput3">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- 上传图片模态框添加相册 -->
<div class="modal fade " id="imageUploadModal3_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload3_1" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput3_1">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- 上传图片模态框添加相册 -->
<div class="modal fade " id="imageUploadModal3_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload3_2" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput3_2">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>


<!-- 上传图片模态框添加相册 -->
<div class="modal fade " id="imageUploadModal3_3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">上传图片</h4>
            </div>
            <div class="modal-body no-padding maxh500">
                <div class="images-zone tc thumb-place-holder">

                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left" style="">
                    <div class="btn btn-success fileinput-button pull-left inline-block">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>添加图片...</span>
                        <input id="fileupload3_3" type="file" name="files[]" multiple="" data-text-control="#uiFileUploadInput3_3">
                    </div>
                    <span class="loading action-doing hide inline-block mt5 ml10"><i class="fa fa-refresh fa-spin"></i>&nbsp;文件上传中...</span>
                    <span class="loading action-done hide inline-block mt5 ml10"><i class="fa fa-check-circle-o"></i>&nbsp;上传成功</span>
                </div>
                <button type="button" class="btn btn-default ml20" data-dismiss="modal">保存</button>
            </div>
        </div>
    </div>
</div>

<!-- 日期-->
<script src="<?php echo ASSETS;?>plugins/bootbox.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<link href="<?php echo ASSETS;?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<!-- jquery file upload -->
<script src="<?php echo ASSETS;?>plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<link href="<?php echo ASSETS;?>plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css" />
<!--省市区三级联动-->
<script src="<?php echo ASSETS;?>plugins/jquery.cityselect.js" type="text/javascript"></script>

<script type="text/javascript">


    //选择日期
    function selectDate(o, id) {
        var _id = '#' + id;
        $(_id).datepicker({
            format: 'yyyy-mm-dd',
            language: 'zh-CN'
        }).on("changeDate", function(e) {
            var me = e.target;
            $(this).datepicker('hide');
        });

        $(_id).datepicker('show');

    }

    //楼盘相册删除
    var yc_id = 0;
    $("#img_yc").click(function (){
        $('.div_yc:eq('+parseInt(yc_id+1)+')').remove();
        $('#myModall').modal('hide');
    });



    //BEGIN:上传图片
    function upload() {
        $('#imageUploadModal').modal({});
    }
    //BEGIN:上传图片基本信息
    function upload1() {
        $('#imageUploadModal1').modal({});
    }
    //BEGIN:上传图片基本信息
    function upload3() {
        $("#uiFileUploadInput3").val("");
        $("#imageUploadModal3").find(".thumb-place-holder").html("");
        $('#imageUploadModal3').modal({});
    }

    function upload3_1() {
        $("#uiFileUploadInput3_1").val("");
        $("#imageUploadModal3_1").find(".thumb-place-holder").html("");
        $('#imageUploadModal3_1').modal({});
    }

    function upload3_2() {
        $("#uiFileUploadInput3_2").val("");
        $("#imageUploadModal3_2").find(".thumb-place-holder").html("");
        $('#imageUploadModal3_2').modal({});
    }

    function upload3_3() {
        $("#uiFileUploadInput3_3").val("");
        $("#imageUploadModal3_3").find(".thumb-place-holder").html("");
        $('#imageUploadModal3_3').modal({});
    }

    var file_url = "<?php echo U('admin/house/jqueryFileUpload');?>";
    //上传图片
    function show_img(id_1,id_2){
        $(id_1).fileupload({
            //options
            url: file_url,
            dataType: 'json',
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
            maxFileSize: 999000,
            //event
            add: function(e, data) {
                //指定模态框容器
                data.context = $(id_2);
                var autoUpload = $.blueimp.fileupload.prototype.options.autoUpload;
                if (autoUpload) {
                    data.submit();
                    data.context.find(".action-doing").removeClass("hide");
                }
                return true;
            },

            progressall: function(e, data) {
                //进度条
                var progress = parseInt(data.loaded / data.total * 100, 10);
            },

            done: function(e, data) {
                var fileInput = data.fileInput;
                var inputTextId = fileInput.attr("data-text-control");
                var inputText = $(inputTextId);
                var placeHolder = data.context.find(".thumb-place-holder");
                placeHolder.html("");
                $.each(data.result.files, function (index, file) {
                    if (file.thumbnailUrl) {

                        $("<img>").attr("src", file.thumbnailUrl).appendTo(placeHolder);
                        inputText.val(file.url);
                        inputText.attr("data-thumb", file.thumbnailUrl);
                    }
                });

                data.context.find(".action-doing").addClass("hide");
                data.context.find(".action-done").removeClass("hide");

            }

        });
    }

    show_img("#fileupload1","#imageUploadModal1");
    show_img("#fileupload3","#imageUploadModal3");
    show_img("#fileupload3_1","#imageUploadModal3_1");
    show_img("#fileupload3_2","#imageUploadModal3_2");
    show_img("#fileupload3_3","#imageUploadModal3_3");
    show_img("#fileupload","#imageUploadModal");

    //添加户型
    $("#insert").click(function (){
        //初始化
        $('#hx1').val('');
        $('.hx_cx').each(function (){
            $(this).prop('checked',false);
        });
        $('#hx_s').val('');
        $('#hx_t').val('');
        $('#hx_w').val('');

        $("#uiFileUploadInput").val("");
        $("#imageUploadModal").find(".thumb-place-holder").html("");
        $('#myhintModal').modal('show');
    });

    //添加户型模态框确认事件
    $("#submt").click(function (){
        if($.trim($("#hx1").val()) ==''){
            if($("#hx1").next().text() != '户型名称不能为空'){
                $("#hx1").after('<span class=".ti_mes" style="color: red">户型名称不能为空</span>');
                $("#hx1").focus();
            }
            return false;
        }else{
            $("#hx1").next().remove();
        }


        if($('input[class=hx_cx]:checked').length<=0){
            if($("#dx").text() != '户型朝向不能为空'){
               $("#dx").text('户型朝向不能为空');
                $("#dx").css('color','red');
            }
            return false;
        }else{
            $("#dx").text('');
        }


        if($.trim($("#hx_j").val()) ==''){
            if($("#hx_j").next().text() != '建筑面积'){
                $("#hx_j").after('<span class=".ti_mes" style="color: red">建筑面积</span>');
                $("#hx_j").focus();
            }
            return false;
        }else{
            $("#hx_j").next().remove();
        }

        if($.trim($("#hx_s").val()) ==''){
            if($("#hx_me").text() != '未填写'){
                $("#hx_me").text('未填写');
                $("#hx_me").css('color','red');
                $("#hx_s").focus();
            }
            return false;
        }else{
            $("#hx_me").text('');
        }

        if($.trim($("#hx_t").val()) ==''){
            if($("#hx_me").text() != '未填写'){
                $("#hx_me").text('未填写');
                $("#hx_me").css('color','red');
                $("#hx_t").focus();
            }
            return false;
        }else{
            $("#hx_me").text('');
        }
        if($.trim($("#hx_w").val()) ==''){
            if($("#hx_me").text() != '未填写'){
                $("#hx_me").text('未填写');
                $("#hx_me").css('color','red');
                $("#hx_w").focus();
            }
            return false;
        }else{
            $("#hx_me").text('');
        }
        //户型名称
        $("#tab_2 div:eq(0)").find(".hx").text($('#hx1').val());
        $("#tab_2 div:eq(0)").find(".hx").next().val($('#hx1').val());
        //户型面积
        $("#tab_2 div:eq(0)").find(".hx_mj").text($('#hx_j').val());
        $("#tab_2 div:eq(0)").find(".hx_mj").next().val($('#hx_j').val());
        //户型朝向
        var string ='';
        $('.hx_cx:checked').each(function (){
            string += ','+$(this).next().text();
        });
            string = string.substring(1);
        $("#tab_2 div:eq(0)").find(".hx_cx").text(string);
        $("#tab_2 div:eq(0)").find(".hx_cx").next().val(string);
        //居室
        var ty= $('#hx_s').val()+'室'+$('#hx_t').val()+'厅'+$('#hx_w').val()+'卫';
        $("#tab_2 div:eq(0)").find(".hx_type").text(ty);
        $("#tab_2 div:eq(0)").find(".hx_type").next().val($('#hx_s').val());
        $("#tab_2 div:eq(0)").find(".hx_type").next().next().val($('#hx_t').val());
        $("#tab_2 div:eq(0)").find(".hx_type").next().next().next().val($('#hx_w').val());
        //缩略图
        var img_url = $("#uiFileUploadInput").val();
        var img_thumb_url = $("#uiFileUploadInput").attr("data-thumb");
        $("#tab_2 div:eq(0)").find(".thumb").attr("src", img_thumb_url);
        $("#tab_2 div:eq(0)").find(".hide_thumb").val(img_url);

        var new1=$("#tab_2 div:eq(0)").find('div').first().clone(true);
        $("#new_cont").append(new1);
        $('#myhintModal').modal('hide');
        //$('#file')[0].files[0]='';
    });
    function cc(a){
        $(a).css('color','red');
    }
    function c1(a){
        $(a).css('color','black');
    }
    function c2(a){
            $(a).parent().parent().slideUp(800).remove();
    }

    //楼盘相册移除
    function yc(a){
        yc_id = parseInt($(a).parent().parent().index());
        $('#myModall').modal('show');
    }
    //添加相册
    $("#inser_img").click(function (){
        $('#kf').val('');
        $("#uiFileUploadInput3").val('');
        $("#uiFileUploadInput3_1").val('');
        $("#uiFileUploadInput3_2").val('');
        $("#uiFileUploadInput3_3").val('');

        $("#uiFileUploadInput3").attr("data-thumb",'');
        $("#uiFileUploadInput3_1").attr("data-thumb",'');
        $("#uiFileUploadInput3_2").attr("data-thumb",'');
        $("#uiFileUploadInput3_3").attr("data-thumb",'');
        $("#Modal").modal('show');

        //缩略图
    });
    //添加楼盘相册
    $("#ok_insert_img").click(function (){
        if($.trim($("#kf").val()) == ''){
            if($("#kf").next().text() ==''){
                $("#kf").next().text('楼盘相册不能为空!');
            }
            return false;
        }

        var img_url = $("#uiFileUploadInput3").val();
        var img_thumb_url = $("#uiFileUploadInput3").attr("data-thumb");
        $("#tab_3 div:eq(0)").find(".thumb1").attr("src", img_thumb_url);
        $("#tab_3 div:eq(0)").find(".hide_thumb1").val(img_url);

        var img_url_1 = $("#uiFileUploadInput3_1").val();
        var img_thumb_url_1 = $("#uiFileUploadInput3_1").attr("data-thumb");
        $("#tab_3 div:eq(0)").find(".thumb2").attr("src", img_thumb_url_1);
        $("#tab_3 div:eq(0)").find(".hide_thumb1_1").val(img_url_1);

        var img_url_2 = $("#uiFileUploadInput3_2").val();
        var img_thumb_url_2 = $("#uiFileUploadInput3_2").attr("data-thumb");
        $("#tab_3 div:eq(0)").find(".thumb3").attr("src", img_thumb_url_2);
        $("#tab_3 div:eq(0)").find(".hide_thumb1_2").val(img_url_2);

        var img_url_3 = $("#uiFileUploadInput3_3").val();
        var img_thumb_url_3 = $("#uiFileUploadInput3_3").attr("data-thumb");
        $("#tab_3 div:eq(0)").find(".thumb4").attr("src", img_thumb_url_3);
        $("#tab_3 div:eq(0)").find(".hide_thumb1_3").val(img_url_3);

        $('#lp_text').text($('#kf').val());
        $('#lp_text').next().val($('#kf').val());

        $("#insert_img_new").append($("#tab_3 div:eq(0)").find('div').first().clone(true));

        $("#Modal").modal('hide');
    });

    //提交按钮
    function sumi(){
        var str = $('#uiFileUploadInput1').attr('data-thumb');
        $('#jb_image').val(str);
        if($.trim($("input[name=house_name]").val()) ==''){
            if($("input[name=house_name]").next().text() != '楼盘名称不能为空') {
                $("input[name=house_name]").after('<span class=".ti_mes" style="color: red">楼盘名称不能为空</span>');
                $("input[name=house_name]").focus();
            }
                return false;
        }else{
            $('input[name=house_name]').next().remove();
        }

        if($.trim($("input[name=house_mess]").val()) ==''){
            if($("input[name=house_mess]").next().text() != '楼盘简介不能为空') {
                $("input[name=house_mess]").after('<span class=".ti_mes" style="color: red">楼盘简介不能为空</span>');
                $("input[name=house_mess]").focus();
            }
            return false;
        }else{
            $('input[name=house_mess]').next().remove();
        }


        if($.trim($("input[name=house_money]").val()) ==''){
            if($("input[name=house_money]").next().text() != '楼盘价格不能为空') {
                $("input[name=house_money]").after('<span class=".ti_mes" style="color: red;">楼盘价格不能为空</span>');
                $("#mon").hide();
                $("input[name=house_money]").focus();
            }
            return false;
        }else{
            $('input[name=house_money]').next().remove();
            $("#mon").show();
        }

        form1.submit();
    }


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