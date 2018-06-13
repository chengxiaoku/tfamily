<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- http://www.htmleaf.com/jQuery/Form/201607033680.html -->
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>可拖拽和带预览图的jQuery文件上传插件|DEMO_jQuery之家-自由分享jQuery、html5、css3的插件库</title>
	<link rel="stylesheet" type="text/css" href="./Application/admin/View/Image/public/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="./Application/admin/View/Image/public/css/htmleaf-demo.css">
	<link rel="stylesheet" href="./Application/admin/View/Image/public/css/ssi-uploader.css"/>
	<!--[if IE]>
		<script src="http://libs.useso.com/js/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="htmleaf-container">
		<div class="container">
			<h3>注意：因为演示中没有后台上传程序的支持，点击上传按钮时会返回错误信息！</h3>
			<div class="row">
				<div class="col-md-12">
					<h3>基本演示（支持jpg、gif、txt、png和pdf格式文件）</h3>
					<input type="file" multiple id="ssi-upload"/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>无预览图效果：</h3>
					<input type="file" multiple id="ssi-upload2"/>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h3>不带拖放区域：</h3>
					<input type="file" multiple id="ssi-upload3"/>
				</div>
			</div>
		</div>
		<div class="related">
		    <h3>如果你喜欢这个插件，那么你可能也喜欢:</h3>
		    <a href="http://www.htmleaf.com/html5/html5muban/201505091801.html">
			  <img src="./Application/admin/View/Image/public/related/1.jpg" width="300" alt="基于Bootstrap 3可预览的HTML5文件上传插件"/>
			  <h3>基于Bootstrap 3可预览的HTML5文件上传插件</h3>
			</a>
			<a href="http://www.htmleaf.com/jQuery/Form/201510142663.html">
			  <img src="./Application/admin/View/Image/public/related/2.jpg" width="300" alt="可拖拽文件的jQuery文件上传控件美化插件"/>
			  <h3>可拖拽文件的jQuery文件上传控件美化插件</h3>
			</a>
		</div>
	</div>
	
	<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
	<script>window.jQuery || document.write('<script src="./Application/admin/View/Image/public/js/jquery-2.1.1.min.js"><\/script>')</script>
	<script src="./Application/admin/View/Image/public/js/ssi-uploader.js"></script>
	<script type="text/javascript">
		$('#ssi-upload').ssi_uploader({
			url:"<?php echo U('admin/Image/jqueryFileUpload');?>",
			maxFileSize:6,
			allowed:['jpg','gif','txt','png','pdf'],
			beforeUpload:function(){
				console.log('文件上传准备就绪！');
			}
		});
		$('#ssi-upload2').ssi_uploader({
			url:"<?php echo U('admin/Image/jqueryFileUpload');?>",
			preview:false,
			allowed:['jpg','gif','txt','png','pdf']
		});
		$('#ssi-upload3').ssi_uploader({
			url:"<?php echo U('admin/Image/jqueryFileUpload');?>",
			dropZone:false,
			allowed:['jpg','gif','txt','png','pdf']
		});
	</script>
</body>
</html>