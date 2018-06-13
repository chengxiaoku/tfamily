<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class AboutController extends BaseController {
    public function index() {
        $this->assign("page_title", "关于我们");
        $this->display();
    }
}