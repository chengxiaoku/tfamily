<?php
/**
 * 全局配置文件
 */
return array(
    // 设置默认的访问模块
    'DEFAULT_MODULE' => 'Home',
    // 设置允许访问的模块列表
    'MODULE_ALLOW_LIST' => array('Home','Admin','Member','Agent','Weixin'),
    // 设置禁止访问的模块列表
    'MODULE_DENY_LIST' => array('Common','Runtime','Api'),
    // URL地址不区分大小写
    'URL_CASE_INSENSITIVE' => true,
    // URL普通模式（0：普通，1：PATHINFO模式，2：REWRITE模式，3：兼容模式）
    'URL_MODEL' => 0,
    // 默认模块获取变量
    'VAR_MODULE' => 'm',
    // 默认控制器获取变量
    'VAR_CONTROLLER' => 'c',
    // 默认操作获取变量
    'VAR_ACTION' => 'a',
    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'db,options,lp_con,car,city',
    //信息提示模板
    'TMPL_ACTION_ERROR' => 'Public/error_jump', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public/success_jump', // 默认成功跳转对应的模板文件

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' => false,

    //会话过期时间
    'SESSION_EXPIRE' => 3600*24,
    
);