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
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-solid">
                    <!-- form start -->
                    <form role="form" id="form">
                        <div class="box-body">
                            <div class="form-group" id="Name">
                                <label for="">栏目名称 <span class="required">*</span></label>
                                <div>
                                    <input type="text" class="form-control wp50 inline-block"
                                           placeholder="输入栏目名称 ..." value="">
                                    <label for="inputError" class="control-label hidden"><i
                                            class="fa fa-times-circle-o"></i> 该栏目名称已存在</label>
                                    <em class="help-block"></em>
                                </div>
                            </div>

                            <div class="form-group " id="Category">
                                <label>选择父栏目</label>
                                <div>
                                    <select class="form-control wp50 inline-block">
                                        <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data['id']); ?>"><?php echo ($data['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                    <label for="inputError" class="control-label hidden"><i
                                            class="fa fa-times-circle-o"></i>请选择栏目！</label>
                                    <em class="help-block"></em>
                                </div>
                            </div>

                            <div class="form-group" id="Image">
                                <label for="">栏目缩略图</label>
                                <div>
                                    <div class="input-group wp50">
                                        <input class=" form-control" placeholder="上传缩略图 ..."
                                               type="text">
                                        <div class="input-group-btn">
                                            <button class="btn btn-success btn-flat" type="button"
                                                    onclick="upload()"><i class="fa fw fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                    <label for="inputError" class="control-label hidden"><i class="fa fa-times-circle-o"></i>请选择一张图片！</label>
                                    <em class="help-block"></em>
                                </div>
                            </div>
                            <div class="form-group" id="Discription">
                                <label>描述</label>
                                <textarea placeholder="输入描述 ..." rows="3" class="form-control wp50"></textarea>
                                <label for="inputError" class="control-label hidden"><i class="fa fa-times-circle-o"></i>请添加描述</label>
                            </div>

                            <div class="form-group" id="Ismenu">
                                <label for="">是否设置为菜单</label>
                                <div>
                                    <div class="radio inline-block mt0">
                                        <label>
                                            <input value="1" name="optionsRadios" type="radio">是
                                        </label>
                                    </div>
                                    <div class="radio inline-block mt0 ml20">
                                        <label>
                                            <input checked="" value="0"name="optionsRadios" type="radio">否
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button class="btn btn-primary w100" onclick="return Submit()" type="submit">保存</button>
                            <a onclick="history.go('-1')" class="btn btn-info w100 mr20" type="submit">返回</a>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- 上传图片 -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">上传图片</h4>
            </div>

            <div class="modal-body no-padding maxh500">

                <div class="images-zone"></div>

            </div>

            <div class="modal-footer">
                <div class="loading pull-left" style="">
                    <button type="button" class="btn btn-success" data-dismiss="modal">选择图片</button>
                    <button type="button" class="btn btn-default mr20" data-dismiss="modal">上传图片</button>
                    <i class="fa fa-refresh fa-spin"></i>&nbsp; 数据加载中...
                </div>
                <button type="button" class="btn btn-default mr20" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function trim (str, charlist) {
        var whitespace = [
            ' ',
            '\n',
            '\r',
            '\t',
            '\f',
            '\x0b',
            '\xa0',
            '\u2000',
            '\u2001',
            '\u2002',
            '\u2003',
            '\u2004',
            '\u2005',
            '\u2006',
            '\u2007',
            '\u2008',
            '\u2009',
            '\u200a',
            '\u200b',
            '\u2028',
            '\u2029',
            '\u3000'
        ].join('')
        var l = 0
        var i = 0
        str += ''

        if (charlist) {
            whitespace = (charlist + '').replace(/([\[\]\(\)\.\?\/\*\{}+$^:])/g, '$1')
        }

        l = str.length
        for (i = 0; i < l; i++) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(i)
                break
            }
        }

        l = str.length
        for (i = l - 1; i >= 0; i--) {
            if (whitespace.indexOf(str.charAt(i)) === -1) {
                str = str.substring(0, i + 1)
                break
            }
        }

        return whitespace.indexOf(str.charAt(0)) === -1 ? str : ''
    }

        //提交验证
        function Submit() {
            if(trim($('#Name div input').val()) == '' || $('#Category div select').val() == 0 || $('#Image div div input').val() == '' || trim($('#Discription textarea').val()) == ''){
                if (trim($('#Discription textarea').val()) == ''){
                    $('#Discription').addClass('has-error');
                    $('#Discription label').removeClass('hidden');
                    $('#Discription textarea').focus();
                }else {
                    $('#Discription').removeClass('has-error');
                    $('#Discription label').addClass('hidden');
                }

                if ($('#Image div div input').val() == ''){
                    $('#Image').addClass('has-error');
                    $('#Image div label').removeClass('hidden');
                    $('#Image div div input').focus();
                }else {
                    $('#Image').removeClass('has-error');
                    $('#Image div label').addClass('hidden');
                }
                if ($('#Category div select').val() == 0){
                    $('#Category').addClass('has-error');
                    $('#Category div label').removeClass('hidden');
                    $('#Category div select').focus();
                }else {
                    $('#Category').removeClass('has-error');
                    $('#Category div label').addClass('hidden');
                }
                if (trim($('#Name div input').val()) == ''){
                    $('#Name').addClass('has-error');
                    $('#Name div label').removeClass('hidden');
                    $('#Name div input').focus();
                }else {
                    $('#Name').removeClass('has-error');
                    $('#Name div label').addClass('hidden');
                }

                return false;
            }else {
                return true;
            }

        }
        row = "<?php echo ($row); ?>";
        if(row != ''){
            var name = "<?php echo ($row['name']); ?>";
            var parentid = "<?php echo ($row['parentid']); ?>";
            var thumb = "<?php echo ($row['thumb']); ?>";
            var description = "<?php echo ($row['description']); ?>";
            var ismenu = "<?php echo ($row['ismenu']); ?>";

            $('#Name div input').val(name);

            var Inselect = $('#Category div select option');
            for (var i=0; i<Inselect.length; i++){
                if(parentid == Inselect[i].value){
                    Inselect[i].selected = 'true';
                }
            }

            $('#Image div div input').val(thumb);

            $('#Discription textarea').text(description);

            var Inradio= $('#Ismenu div div label input');
            for (var i=0; i<Inradio.length; i++){
                Inradio[i].checked = false;
            }
            ismenu == 1 ? Inradio[0].checked =  true: Inradio[1].checked =  true;
        }

        var pid = "<?php echo ((isset($pid) && ($pid !== ""))?($pid):''); ?>";
        if (pid != ''){
            var Inselect = $('#Category div select option');
            for (var i=0; i<Inselect.length; i++){
                if(pid == Inselect[i].value){
                    Inselect[i].selected = true;
                }
            }
            $('#Category div select').attr('disabled',true);
        }
        //上传图片
        function upload() {
            $('#myModal').modal({});
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