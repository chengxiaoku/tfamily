<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;

/**
 * 页面参考控制器
 * Created by PhpStorm.
 * @User: Administrator
 * @Date: 2016/11/9
 * @Time: 23:37
 */
class UiController extends BaseController {

    /**
     * 空白页面
     */
    public function blank() {
        $this->assign("page_title", "空白页面");
        $this->display();
    }

    /**
     * 页面元素参考
     */
    public function index() {
        $this->assign("page_title", "页面元素参考");
        $this->display();
    }

    /**
     * 信息提示页面
     */
    public function message() {
        $this->assign("page_title", "信息提示页面");
        $this->display();
    }

    public function hello() {
        $this->assign("page_title", "页面标题");
        $this->display();
    }
}