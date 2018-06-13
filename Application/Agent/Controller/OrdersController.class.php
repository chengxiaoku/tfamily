<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;
use Common\Util;

/**
 * Created by PhpStorm.
 * User: dyy15250
 * Date: 2016/11/21
 * Time: 13:02
 */
class OrdersController extends BaseController{
    public function index(){
        $user = $this->getUser();
        $user_id = $user['id'];
        $mysql = M();
        //当前页数
        $p = empty($_GET['p'])?1:$_GET['p'];
        //分页
        $page_size = C("PAGE_SIZE");
        $offset = ($p-1)*$page_size;
        $sql1 = "select count(id) as number from tf_orders where user_id = $user_id ";
        $rs1 = $mysql->query($sql1);
        $page = new Util\MyPage($rs1[0]['number'],$page_size);
        $show = $page->show();
        $this->assign('page_html',$show);
        //拉取数据
        $sql = "SELECT * FROM `tf_orders` where user_id = $user_id ORDER BY `add_time` Desc LIMIT $offset,$page_size ";
        $rs = $mysql->query($sql);
        $this->assign('content',$rs);
        //页面标题
        $this->assign("page_title", "我的订单");
        $this->display();
    }
    public function detail(){
        $id = $_GET['id'];
        $mysql = M();
        $sql = "select * from tf_orders where id = $id";
        $rs = $mysql->query($sql);
        $this->assign('content',$rs[0]);
        //页面标题
        $this->assign("page_title", "订单详情");
        $this->display();
    }
}