<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class PositionController extends BaseController {
    public function index() {
        $open_city = C('OPEN_CITY');
        $this->assign("open_city",$open_city);
        if (empty(cookie("position") or empty(cookie("position_id")))) {
            cookie("position" , "洛阳市");
            cookie("position_id" , 189);
        }
        $this->assign("position",cookie("position"));
        $this->assign("page_title", "选择城市");
        $this->display();
    }
    public function location() {
        $id = I('post.id');
        $name = I('post.name');
        if ($id == '') {
            cookie('position','洛阳市');
            cookie('position_id',189);
        } else {
            cookie('position', $name);
            cookie('position_id',$id);
        }
    }
}