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

    <!-- 主体内容 -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body padding20">
                            <div class="form-group has-error">
                                <label for="">设置字段A<span class="required">*</span></label>
                                <div>
                                    <input type="text" placeholder="输入设置字段A" id=""
                                           class="form-control wp50 inline-block">
                                    <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        设置字段A</label>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label for="">设置字段B</label>
                                <div>
                                    <input type="text" class="form-control wp50 inline-block" id="inputSuccess"
                                           placeholder="输入 ...">
                                    <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i>
                                        验证成功提示</label>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label for="">警告信息</label>
                                <div>
                                    <input type="text" class="form-control wp50 inline-block" id="inputWarning"
                                           placeholder="输入 ...">
                                    <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> 警告提示信息</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">设置字段B<span class="required">*</span></label>
                                <input type="text" placeholder="输入设置字段B" id="" class="form-control wp50">
                            </div>
                            <div class="form-group">
                                <label>字段失效</label>
                                <input type="text" value="[大首][首页][底部]980*90" disabled="" class="form-control wp50">
                                <!-- <div class="input-group wp50">

                <div class="input-group-addon">
                  <i class="fa  fa-flag-o"></i>
                </div>
              </div> -->
                            </div>
                            <div class="form-group input-group wp50">
                                <label for="">日期字段</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" placeholder="" id="begin-time" class="form-control">
                                        <div class="input-group-btn">
                                            <button onclick="return selectDate(this, 'begin-time')" type="button"
                                                    class="btn btn-success btn-flat"><i class="fa fa-clock-o"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- <em class="help-block"></em> -->
                                </div>
                            </div>
                            <div class="form-group input-group wp50">
                                <label for="">上传图片字段</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="上传缩略图 ..." id="uiFileUploadInput">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-flat" type="button" onclick="upload()"><i
                                                    class="fa fw fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                    <em class="help-block"></em>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>多选框</label>
                                <div>
                                    <div class="checkbox inline-block mt0">
                                        <label>
                                            <input type="checkbox">选项A
                                        </label>
                                    </div>
                                    <div class="checkbox inline-block mt0 ml20">
                                        <label>
                                            <input type="checkbox">选项B
                                        </label>
                                    </div>
                                    <div class="checkbox inline-block mt0 ml20">
                                        <label>
                                            <input type="checkbox">选项C
                                        </label>
                                    </div>
                                    <div class="checkbox inline-block mt0 ml20">
                                        <label>
                                            <input type="checkbox">选项D
                                        </label>
                                    </div>
                                </div>
                                <em class="help-block">说明：备注内容</em>
                            </div>
                            <div class="form-group">
                                <label for="">单选框</label>
                                <div>
                                    <div class="radio inline-block mt0">
                                        <label>
                                            <input type="radio" checked="" value="option1" id="" name="optionsRadios">选项A
                                        </label>
                                    </div>
                                    <div class="radio inline-block mt0 ml20">
                                        <label>
                                            <input type="radio" value="option2" id="" name="optionsRadios">选项B
                                        </label>
                                    </div>
                                    <div class="radio inline-block mt0 ml20">
                                        <label>
                                            <input type="radio" value="option3" id="" name="optionsRadios">选项C
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">下拉框</label>
                                <select class="form-control wp50">
                                    <option value="0">≡ 请选择内容 ≡</option>
                                    <option value="40">选项A</option>
                                    <option value="42">选项B</option>
                                    <option value="44">选项C</option>
                                    <option value="45">选项D</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">带有图标</label>
                                <div class="input-group wp50">
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">带有图标</label>
                                <div class="input-group wp50">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input type="email" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer p20 ">
                            <button class="btn btn-primary w100" type="submit">保存</button>
                            <a onclick="history.go('-1')" class="btn btn-info w100 ml20" type="submit">返回</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
                <div class="box box-solid">
                    <div class="box-header">
                        <i class="fa fa-text-width"></i>
                        <h3 class="box-title">这里是标题 - 表格</h3>
                        <div class="select pull-right">
                            <div style="width:250px; margin-left: 5px;" class="input-group">
                                <input type="text" placeholder="" style="" class="form-control  " name="">
                                <div class="input-group-btn">
                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th width="10%" class="tc">行号</th>
                                <th width="50%">标题</th>
                                <th width="30%" style="text-align:center;">管理操作</th>
                            </tr>
                            <tr>
                                <td class="tc">1</td>
                                <td><a href="#">当我们关注戛纳的时候</a></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-default btn-xs" href="#">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tc">1</td>
                                <td><a href="#">当我们关注戛纳的时候</a></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-default btn-xs" href="#">删除</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="tc">2</td>
                                <td><a href="#">当我们关注戛纳的时候</a></td>
                                <td style="text-align:center;">
                                    <a class="btn btn-default btn-xs" href="#">删除</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="text-right">
                            <ul class="pagination">
                                <li id="example2_previous" class="paginate_button previous disabled"><a tabindex="0"
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
                    <div class="box-footer">
                        <button class="btn btn-primary w100" type="submit">保存</button>
                    </div>
                </div>


                <!--省市区三级联动-->
                <div class="box box-solid">
                    <div class="box-header">
                        <h3 class="box-title">省市区三级联动</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label>选择地区<span class="required"></span></label>
                            <div id="region">
                                <select class="form-control w150 inline-block province"
                                        id="province_id" name="province_id">
                                    <option value="">≡ 请选择省 ≡</option>
                                </select>
                                <select class="form-control w150 inline-block city"
                                        id="city_id" name="city_id">
                                    <option value="">≡ 请选择市 ≡</option>
                                </select>
                                <select class="form-control w150 inline-block district"
                                        id="district_id" name="district_id">
                                    <option value="">≡ 请选择区 ≡</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content  -->


    <!-- 上传图片 -->
    <div class="modal fade " id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">上传图片</h4>
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
                    <button type="button" class="btn btn-default ml20" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>



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
            url: "<?php echo U('admin/ui/getCity');?>",
        });
    });




    //BEGIN：上传图片
    function upload() {
        $('#imageUploadModal').modal({});
    }
    var file_url = "<?php echo U('admin/ui/jqueryFileUpload');?>";
    $("#fileupload").fileupload({
        //options
        url: file_url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 999000,
        //event
        add: function(e, data) {
            //指定模态框容器
            data.context = $("#imageUploadModal");
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

            $.each(data.result.files, function (index, file) {
                if (file.thumbnailUrl) {
                    $("<img>").attr("src", file.thumbnailUrl).appendTo(placeHolder);
                    inputText.val(file.url);
                }
            });

            data.context.find(".action-doing").addClass("hide");
            data.context.find(".action-done").removeClass("hide");

        }

    });
    //END:上传图片



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





    //删除所有
    function delAll() {
        bootbox.confirm("您确定要删除吗？", function(data) {
            if (data == false) {
                alert("取消");
            } else {
                alert("确定");
            }
        });
    }

    function del() {

        //bootbox.alert(message, callback)
        //bootbox.prompt(message, callback)
        bootbox.confirm("确认要删除该会员组？", function(data) {
            if (data == false) {
                alert("取消");
            } else {
                alert("确定");
            }
        })

    }


</script>

<!--公共底部页面-->
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