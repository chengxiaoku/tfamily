<?php if (!defined('THINK_PATH')) exit();?><!--网页头部-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="<?php echo $_SESSION['site_description']; ?>">
    <meta name="keywords" content="<?php echo $_SESSION['site_keywords']; ?>">
    <title><?php echo ($page_title); ?></title>
    <script type="text/javascript" src="<?php echo HOUSE;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo HOUSE;?>layer/layer.js"></script>
    <script type="text/javascript" src="<?php echo HOUSE;?>bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo HOUSE;?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo HOUSE;?>css/global_new.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HOUSE;?>css/common_new.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo HOUSE;?>css/style_v2.css" />

</head>

<body>
    <!-- 顶部导航和banner -->
    <section class="header">
        <!-- logo&导航 -->
        <section class="wrapper clearfix">
            <!-- logo -->
            <div class="fl"> 
                <a href="javascript:;" class="index_logo" title="T家园"></a>
                <a href="javascript:;" class="index_adr">&#xe60f;<?php echo ($city_name); ?></a>
            </div>
            <!-- 登陆注册 -->
            <div class="fr">
                <ul class="index_nav clearfix">
                    <li class="fl"><a href="<?php echo U('index/index');?>">首页</a></li>
                    <li class="fl"><a href="<?php echo U('House/index');?>" target="_blank">新房</a></li>
                    <li class="fl"><a href="<?php echo U('Car/index');?>">新车</a></li>
                    <li class="fl"><a href="<?php echo U('news/index');?>">资讯</a></li>
                    <li class="fl login_box" style="padding: 3px 7px;">
                        <a href="<?php echo U('Auth/login');?>">登陆</a>
                    </li>
                </ul>

            </div>
        </section>
        <!-- banner内容 -->
        <section class="index_banner">
            <!-- 网站宣传标语 -->
            <section class="index_title" >
                <div class="nh_banner_tit">T家园创业平台，帮您找到梦想中的家</div>
            </section>
            <!-- 搜索引擎框体 -->
            <!--<a href="../House/index.html" target="_blank">-->
            <form action="<?php echo U('House/house_select');?>" method="post" class="index_search clearfix">
                <input type="text" name="house_name" placeholder="请输入楼盘名称">
                <input type="submit" value="开始找房">
            </form>
            </a>
        </section>
    </section>

    <!-- 功能展示区域 -->
    <ul class="wrapper clearfix index_fun">
        <li class="fl">
            <div class="box">
                <a class="thumb" href="<?php echo U('Page/bargain');?>"><img src="<?php echo HOUSE;?>image/icon-mm.png" height="70" alt=""></a>
                <p class="title">抱团砍价</p>
                <div>一个人砍太累，合砍才实惠！</div>
                <div>无优惠，不买房！抱团砍价,必有惊喜</div>
            </div>
        </li>

        <li class="fl">
            <div class="box">
                <a class="thumb"  href="<?php echo U('Page/entrepreneurship');?>"><img src="<?php echo HOUSE;?>image/icon-one.png" height="70" alt=""></>
                <p class="title">创业就业</p>
                <div>成为T会员获取消费收益和提成奖励</div>
                <div>实现提成本创业，获取更大利润回报</div>
            </div>
        </li>
        <li class="fl">
            <div class="box">
                <a class="thumb"  href="<?php echo U('Page/make_money');?>"><img src="<?php echo HOUSE;?>image/icon-money.png" height="70" alt=""></a>
                <p class="title">赚钱省钱</p>
                <div>推荐既有奖励，开启您的创业激情</div>
                <div>互联网与实体商家完美融合</div>
            </div>
        </li>
        <li class="fl">
            <div class="box">
                <a class="thumb"  href="<?php echo U('Page/service');?>"><img src="<?php echo HOUSE;?>image/icon-car.png" height="70" alt=""></a>
                <p class="title">专车接送</p>
                <div>专车接送，全程陪同看房</div>
                <div>好房不必等，优质更低价！</div>
            </div>
        </li>
    </ul>

    <img src="<?php echo ASSETS;?>img/line.png" style="display:block;margin:0 auto;margin-top:50px;" alt="">


    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 500px;width: 1150px;margin: 30px auto;">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php if(is_array($img)): foreach($img as $key=>$row): ?><li data-target="#carousel-example-generic" data-slide-to="<?php echo ($key-1); ?>"></li><?php endforeach; endif; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox" >
            <?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><div class="item">
                    <a href="<?php echo ($row["url"]); ?>">
                        <img src="<?php echo ($row["img"]); ?>" style="height: 500px;width: 1150px;">
                    </a>
                    <div class="carousel-caption">
                        <?php echo ($row["text"]); ?>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- 新房源 -->
    <section class="newhouse2" id="ershoufanglist">
        <div class="wrapper">
            <h3>最新楼盘</h3>
            <p>真实信息准确同步，楼盘动态一手掌握
                <a href="<?php echo U('House/index');?>" class="pull-right more">更多新房</a>
            </p>
            <ul class="clearfix new">
                <?php if(is_array($new_house)): $i = 0; $__LIST__ = $new_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo U('House/house_detail');?>&id = <?php echo ($row["id"]); ?>" target="_blank">
                        <div class="wra shadowv">
                            <img src="<?php echo ($row["thumb"]); ?>">
                            <span class="price"><?php echo ($row["price"]); ?>元/平</span>
                            <div class="bottom">
                                <p style="font-size: 16px; padding: 10px 20px 0 20px;" title="<?php echo ($row["summary"]); ?>"><?php echo ($row["title"]); ?>:<?php echo (my_substr($row["summary"],0,16)); ?></p>
                            </div>
                        </div>
                        <div class="tips">
                            <p>
                                <span><?php echo ($row["title"]); ?></span>
                                <span><?php echo ($row["rooms"]); ?>室</span>
                                <span><?php echo ($row["max_area"]); ?>平米</span>
                            </p>
                        </div>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </section>

    <!-- 优质楼盘推荐 -->
    <section class="new_house">
        <div class="wrapper">
            <h3>优质楼盘</h3>
            <p>
            真实信息准确同步，楼盘动态一手掌握
            <a class="pull-right more" href="<?php echo U('House/index');?>">更多优质楼盘</a>
            </p>
            <div class="newhose_list">
            <ul clas="row clearfix">
                <?php if(is_array($hot_house)): $i = 0; $__LIST__ = $hot_house;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><li style="background: url(<?php echo ($row["thumb"]); ?>)">
                        <a href="<?php echo U('House/house_detail');?>&id = <?php echo ($row["id"]); ?>" target="_blank">
                            <div class="bg"></div>
                            <div class="title"><?php echo ($row["title"]); ?><span><?php echo ($row["price"]); ?>元/平</span></div>
                            <div class="title01"></div>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
        </div>
    </section>


    <style>
        .nh_banner_tit {
            color: #fff;
            font-size: 50px;
            font-weight: 900;
            padding-top: 0;
            text-align: center;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .footer{
            margin-top:0;
        }
        .index_fun .box {
            text-align: center;
            width: 100%;

        }

        .index_fun .box img {
            display: block;
            margin:0 auto;
        }

        .index_fun .box .title {
            color: #394043;
            font-size: 18px;
            padding: 10px 0;

        }

        .index_fun .box div {
            color: #b0b3b4;
            font-size: 12px;
            text-align: center;
        }

        .city {
            position: relative;
            padding: 10px;
        }
        .city a {
            border: 1px solid #d2d2d2;
            border-radius: 15px;
            color: #888;
            height: 26px;
			text-align: center;
            line-height: 26px;
            margin: 5px 12px;
            text-decoration: none;
            width: 110px;
            display: inline-block;
            float: left;
        }
        .city a:hover {
            background-color: #f8f8f8;
        }

    </style>

    <!--广告幻灯片-->
    <script type="text/javascript">
        $('.carousel-indicators li:eq(0)').addClass('active');
        $('.carousel-inner div:eq(0)').addClass('active');
    </script>

    <script type="text/javascript">
        //弹出选择城市
        $(".index_adr").on('click',function(){
            $.post('<?php echo U(region);?>',{provice_id:1},function(data){
                var address = '';
                $.each(data,function(i,provices){
                    //拼成样式
                    address+='<a href="javascript:;" id="'+provices.id+'" onclick="city('+provices.id+')" style="">'+provices.name+'</a>';
                });

                layer.open({
                    type: 1,
                    //title:false,
                    title: "选择城市",
                    skin: 'layui-layer-demo', //样式类名
                    closeBtn: 1, //不显示关闭按钮
                    shift: 2,
                    area: ['570px', '470px'],
                    shadeClose: true, //开启遮罩关闭
                    content: '<div class="city">'+address + '</div>'
                });
                $("#<?php echo ($city_id); ?>").css({
                    "color":"#3FBE65",
                    "border":'1px solid #3FBE65'
                });
            });

        })

        //获取市并存入cookie
        var i = null;
        function city(id) {

            layer.closeAll();
            $.post('<?php echo U(region);?>', {city_id: id}, function () {
                location.href="<?php echo U('index/index');?>";
            });
        }

        $(function(){
            $('.new li:eq(3)').css('margin-right','0px');
        })

        //searchHouse底部查询房
        function searchHouses(){
            searchHousee.submit();
        }

    </script>
<!--网页底部-->
<!--尾部 -->
<section class='footer'>
    <section class="wrapper clearfix" style="padding-bottom: 10px;">
        <p class="footer_fl">
            <a href="<?php echo U('Page/aboutus');?>">
                关于T家园
            </a>

            <a href="<?php echo U('Page/help');?>">
                帮助中心
            </a>
            
            <a href="<?php echo U('Page/contactus');?>">
                联系我们
            </a>
            <a href="<?php echo U('Page/joinus');?>">
                加入我们
            </a>
            <a href="<?php echo U('Page/privacynotice');?>">
                隐私声明
            </a>
        </p>
        <p class="copyright" style="margin-top: 10px;">
            Copyright © 2016 tjiayuan.com 洛阳T家园科技股份有限公司 版权所有   网站备案/许可证号：豫TCP备16036410号-1
        </p>

    </section>

</section>
<!--判断登陆修改头部按钮-->
<script type="text/javascript">
    $(function(){
        if ("<?php echo $_SESSION['user_id'] ?>" != '' || "<?php echo $_SESSION['_member_user_id'] ?>" != '') {
            //判断个人中心往哪里跳转
            if ("<?php echo $_SESSION['user_id'] ?>" != '') {
                var url ="./agent.php"
            } else if("<?php echo $_SESSION['_member_user_id'] ?>" != ''){
                var url = "./member.php";
            }

            //首页头部更改
            var indexs ='';
            indexs += '<li class="fl login_box" style="padding: 3px 7px;">';
            indexs += '<a href="'+url+'">个人中心</a>';
            indexs += '</li>';
            indexs += '<li class="fl login_box" style="padding: 3px 7px;">';
            indexs += '<a href="<?php echo U("Auth/logout");?>&curl=<?php echo CONTROLLER_NAME ?>&aurl=<?php echo ACTION_NAME ?>">退出</a>';
            indexs += '</li>';
            $('.index_nav li:last').remove();
            $('.index_nav').append(indexs);

            //其他页面导航栏更改
            var navber = '';
            navber += '<div class="normal_login fr normal_login01 ">';
            navber += '<a href="<?php echo U("Auth/logout");?>&curl=<?php echo CONTROLLER_NAME ?>&aurl=<?php echo ACTION_NAME ?>">退出</a>';
            navber += '</div>';
            navber += '<div class="normal_login fr normal_login01 ">';
            navber += '<a href="'+url+'">个人中心</a>';
            navber += '</div>';
            $('.navber_top div').remove();
            $('.navber_top').append(navber);

        }
    })
</script>


<!-- 返回顶部事件 -->
<script type="text/javascript">
    var hei = $(window).height();
    $(window).scroll(function(){
        var sr = $(window).scrollTop();
        if(sr>hei){
            $(".totop").stop().fadeIn(300);
        }
        if(sr<=hei){
            $(".totop").stop().fadeOut(300);
        }
    })
    $(".totop").click(function(){
        $('html,body').stop().animate({"scrollTop":0},600);
    })
</script>
<!-- 侧边栏事件 -->
<script>
    $(".sidebar li").hover(function(){
        $(this).siblings("li").children("div").stop().toggleClass('sho');
    })
    $(".sidebar li a").mouseover(function(){
        $(this).children("p.news_time").stop().slideDown(500);
    })
    $(".sidebar li a").mouseout(function(){
        $(this).children("p.news_time").stop().slideUp(500);
    })
    $(".side07_tab div").click(function(){
        $(this).addClass("side07_tab_cur").siblings("div").removeClass("side07_tab_cur");
        $(".side07_contents div").eq($(this).index()).stop().show(500).siblings("div").stop().hide(500);
    })
</script>
</body>
</html>