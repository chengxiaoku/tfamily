<?php

namespace Admin\Controller;

use Admin\Controller\BaseController;
use Common\Util;

/**
 * 楼盘管理控制器
 * Class IndexController
 * @package Admin\Controller
 * @author CLF 710425820@qq.com
 * @date 2016-11-11
 */
class ImageController extends BaseController
{
    /**
     * 上传图片 插件
     */
    public function index(){
        $this->display();
        spl_autoload_register();    //自动加载 扩展  注册自动加载 更加灵活
    }

    /**
     *MYSQL TP框架测试
     */
    public function test(){
        $admin = M('admin');
        //$data = $admin->create();
        //AR 方法添加数据 name 指数据库的字段 类似 data['name'] = XXX
        //$admin->name = I('post.name');
        //$admin->add();
        
        //echo MODULE_NAME;  //获取当前模块名
        //echo CONTROLLER_NAME; //获取当前控制器名
        //echo ACTION_NAME;//获取当前方法名
        
        $this->display();
    }


}