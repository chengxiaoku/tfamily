<?php
/**
 * T家园创业平台 - 微信端模块 - Weixin
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/28
 * Time: 14:45
 */

//开启调试模式
define("APP_DEBUG", TRUE);
//绑定Weixin模块到当前入口文件
define('BIND_MODULE','Weixin');
//定义应用目录
define("APP_PATH", "./Application/");
//定义目录分隔符简写形式
define("DS", DIRECTORY_SEPARATOR);
//定义网站根目录
define("ROOT_PATH", dirname(__FILE__) . DS);
//加载框架入口文件
include './ThinkPHP/ThinkPHP.php';