<?php
/**
 * 网站配置信息
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 21:48
 */
return array(
    'SITE_NAME' => 'T家园创业平台',
    'SITE_URL' => 'http://localhost/tfamily',   //网站名


    //平台用户角色
    'USER_ROLES' => array(

    ),

    //奖金业务类型
    'BUSINESS_TYPE' => array(
        'cash'              => '提现',
        'award_integral'    => '积分奖励',
        'award_team'        => '组团奖励',   //组团奖励，每组建团队成功后自动发放奖励
        'award_bonus'       => '分红奖励',  //每年分红奖励
        'award_referee'     => '推荐奖励',  //推荐下线奖励
        'award_fans'        => '粉丝奖励',     //推荐粉丝奖励
        'year_salary'       => '年薪',        // 每年发放薪水
        'other'             => '其他',            //预留
    ),

    //楼盘物业类型
    'HOUSE_PRO_TYPE' => array(
        'ptzz' => '普通住宅',
        'gy' => '公寓',
        'hyyf' => '花园式洋房',
        'bs' => '别墅',
        'xzl' => '写字楼',
        'sp' => '商铺',
        'szly' => '商住两用'
    ),
    
    'HOUSE_TYPE' => array(
        'one' => '一室',
        'two' => '二室',
        'three' => '三室',
        'four' => '四室',
        'five' => '五室',
        'six' => '六室',
        'other' => '不限'
    )
);