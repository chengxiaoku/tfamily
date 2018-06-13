<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class GroupController extends BaseController {
    public function index() {
        $this->assign("page_title", "团购页面");
        $this->display();
    }
    public function page_error() {
        $this->assign("page_title", "提交团购表单失败提示页面");
        $this->display();
    }
    public function page_success() {
        $this->assign("page_title", "成功提示页面");
        $this->display();
    }
}