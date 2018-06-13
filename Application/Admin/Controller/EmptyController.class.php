<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
/**
 * 当输入的URL 中 有空控制器或不存在的控制器 则调用Empty 类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 18:57
 */
class EmptyController  extends BaseController{

    public function _empty(){
        echo '输入了没有的控制器';
    }
}