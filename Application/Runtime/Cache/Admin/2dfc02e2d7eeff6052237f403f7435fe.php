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
<script src="plugins/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="plugins/ueditor/ueditor.all.min.js" type="text/javascript"></script>

<style>
    .error{
        color: red;
    }
</style>
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
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-solid">
                    <!-- form start -->
                    <form role="form"  id="loginForm" action="<?php echo U('News/add');?>" method="post">
                        <div class="box-body">
                            <div class="form-group ">
                                <label for="">标题 <span class="required">*</span></label>
                                <div>
                                    <input type="text" name="title" class="form-control wp50 inline-block"   placeholder="输入新闻标题 ...">
                                    <!--<label for="inputError" class="control-label"><i class="fa fa-times-circle-o"></i> 该新闻标题已存在</label>-->
                                    <em class="help-block"></em>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>选择栏目</label>
                                <select class="form-control wp50" name="catid">
                                    <option value="0">≡ 请选择栏目 ≡</option>
                                    <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data[id]); ?>"><?php echo ($data[name]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group input-group wp50">
                                <label for="">上传缩略图</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="上传缩略图 ..."
                                               id="uiFileUploadInput" name="thumb">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-flat" type="button" onclick="upload()"><i
                                                    class="fa fw fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                    <em class="help-block"></em>
                                </div>
                             </div>

                            <div class="form-group">
                                <label for="">描述:</label>
                                <div>
                                    <textarea name="description" class="form-control wp50" rows="3" placeholder="描述 ..."></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>内容：</label>
                                <textarea placeholder="输入内容 ..." style="height: 300px;" rows="3" class="form-control wp50 " name="content"></textarea>

                            </div>

                        </div>
                        <div class="box-footer">
                            <button class="btn btn-primary w100" type="submit"  onclick="return login()">保存</button>
                            <a onclick="history.go('-1')" class="btn btn-info w100 ml20" type="submit">返回</a>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>
    </section>
</div>
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

<script src="<?php echo ASSETS;?>plugins/ueditor/ueditor.config.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/ueditor/ueditor.all.min.js" type="text/javascript"></script>

<script src="<?php echo ASSETS;?>plugins/jquery-validate/jquery.validate.min.js"></script>
<script src="<?php echo ASSETS;?>plugins/jquery-validate/localization/messages_zh.min.js"></script>
<script src="<?php echo ASSETS;?>plugins/bootbox.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
<link href="<?php echo ASSETS;?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css"/>
<!-- jquery file upload -->
<script src="<?php echo ASSETS;?>plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo ASSETS;?>plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<link href="<?php echo ASSETS;?>plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript">
    function login() {

        $("#loginForm").validate({
            rules: {
                title: "required",

            },
            messages: {
                title: "标题不能为空",

            }
        });

        return true;
    }

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


</script>