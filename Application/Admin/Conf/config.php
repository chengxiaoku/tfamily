<?php
/**
 * 总后台配置信息
 */
return array(
	//'配置项'=>'配置值'
    'PAGE_SIZE' => 4,  //数据表格每页显示的数量


    'MENU' => array(
        'index' => array(
            'name' => 'index',
            'title' => '控制面板',
            'm' => 'admin',
            'c' => 'index',
            'a' => 'index',
            'icon' => 'fa fa-dashboard',
            'children' => '',
        ),

        'user' => array(
            'name' => 'user',
            'title' => '用户管理',
            'm' => 'admin',
            'c' => 'user',
            'a' => 'index',
            'icon' => 'fa fa-th',
            'children' => array(
                'province_agent' => array(
                    'name'=>'province_agent',
                    'title'=>'省代理',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'province_agent'
                ),

                'city_agent' => array(
                    'name'=>'city_agent',
                    'title'=>'市代理',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'city_agent'
                ),

                'district_agent' => array(
                    'name'=>'district_agent',
                    'title'=>'区代理',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'district_agent'
                ),

                'member' => array(
                    'name'=>'member',
                    'title'=>'T会员',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'member'
                ),

                'partner' => array(
                    'name'=>'member',
                    'title'=>'合作商家',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'partner'
                ),

                'fan' => array(
                    'name'=>'fan',
                    'title'=>'粉丝',
                    'm'=>'admin',
                    'c'=>'user',
                    'a'=>'fan'
                ),

            ),
        ),

        'car'=>array(
            'name'=>'car',
            'title'=>'汽车管理',
            'm'=>'admin',
            'c'=>'car',
            'a'=>'index',
            'icon' => 'fa fa-th'
        ),

        'house' => array(
            'name' => 'house',
            'title' => '楼盘管理',
            'm' => 'admin',
            'c' => 'house',
            'a' => 'index',
            'icon' => 'fa fa-th',
            'children' => array(
                'index' => array(
                    'name'=>'index',
                    'title'=>'楼盘列表',
                    'm'=>'admin',
                    'c'=>'house',
                    'a'=>'index'
                ),
            ),
        ),

        'order' => array(
            'name' => 'order',
            'title' => '订单管理',
            'm' => 'admin',
            'c' => 'order',
            'a' => 'orders',
            'icon' => 'fa fa-th'
        ),

        'category' => array(
            'name' => 'category',
            'title' => '栏目管理',
            'm' => 'admin',
            'c' => 'category',
            'a' => 'index',
            'icon' => 'fa fa-th'
        ),

        'news' => array(
            'name' => 'news',
            'title' => '新闻管理',
            'm' => 'admin',
            'c' => 'news',
            'a' => 'index',
            'icon' => 'fa fa-th'
        ),

        'comment' => array(
            'name' => 'comment',
            'title' => '评论管理',
            'm' => 'admin',
            'c' => 'comment',
            'a' => 'index',
            'icon' => 'fa  fa-comment'
        ),

        'ad' => array(
            'name' => 'ad',
            'title' => '广告管理',
            'm' => 'admin',
            'c' => 'ad',
            'a' => 'index',
            'icon' => 'fa fa-th'
        ),

        'notice' => array(
            'name' => 'notice',
            'title' => '公告管理',
            'm' => 'admin',
            'c' => 'notice',
            'a' => 'index',
            'icon' => 'fa fa-th'
        ),

        'finance' => array(
            'name' => 'finance',
            'title' => '财务管理',
            'm' => 'admin',
            'c' => 'finance',
            'a' => 'index',
            'icon' => 'fa fa-th'
        ),

        'admin' => array(
            'name' => 'admin',
            'title' => '管理员管理',
            'm' => 'admin',
            'c' => 'admin',
            'a' => 'index',
            'icon' => 'fa fa-th',
            'children' => array(
                'index' => array(
                    'name'=>'index',
                    'title'=>'管理员列表',
                    'm'=>'admin',
                    'c'=>'admin',
                    'a'=>'index'
                ),
                'role' => array(
                    'name'=>'role',
                    'title'=>'角色管理',
                    'm'=>'admin',
                    'c'=>'admin',
                    'a'=>'role'
                ),
            )
        ),

        'setting' => array(
            'name' => 'setting',
            'title' => '基础设置',
            'm' => 'admin',
            'c' => 'setting',
            'a' => 'index',
            'icon' => 'fa fa-th',
            'children' => array(
                'team' => array(
                    'name'=>'team',
                    'title'=>'会员等级',
                    'm'=>'admin',
                    'c'=>'setting',
                    'a'=>'team'
                ),
                'option' => array(
                    'name'=>'option',
                    'title'=>'参数设置',
                    'm'=>'admin',
                    'c'=>'setting',
                    'a'=>'option'
                ),
                'site' => array(
                    'name'=>'site',
                    'title'=>'网站设置',
                    'm'=>'admin',
                    'c'=>'setting',
                    'a'=>'site'
                ),
            )
        ),
    ),
);