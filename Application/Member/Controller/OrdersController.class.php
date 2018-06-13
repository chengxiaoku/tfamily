<?php
namespace Member\Controller;
use Member\Controller\BaseController;
use Think\Model;
use Common\Util\MyPage;
/**
 * Created by PhpStorm
 * Class MoneyController
 * User:郑宇贺
 * Date:2016/11/10
 * Time:17:53
 * Description:描述
 */
class OrdersController extends BaseController
{
    public function index() {

        $this->assign("page_title", "我的订单");
        $user = $this->getUser();
        $user_id = $user['id'];
        $order=M('orders');
        $rs_count=$order->where("`user_id`=$user_id")->count();
        $p = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C("PAGE_SIZE");
        $offset = ($p - 1) * $page_size;
        $data=$order->where("`user_id`=$user_id")->limit($offset.','.$page_size)->select();
        $pager = new MyPage($rs_count, $page_size);
        $page = $pager->show();
        $this->assign("page", $page);
        $this->assign("data", $data);
        $this->display();
    }

    public function detail() {
        $id=$_GET['id'];
        $datail=M('orders');
        $data=$datail->where("`id`= $id")->select();
        $this->assign('data',$data[0]);
        $this->display();
        $this->assign("page_title", "订单详情");

    }

}