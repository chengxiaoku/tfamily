<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;

/**
 ** 余额管理控制器
 * Created by PhpStorm.
 * User: 王天棋
 * Date: 2016/11/22
 * Time: 17:32
 */
class BalanceController extends BaseController {
    public function index() {
        $user=$this->getUser();
        $id=$user['id'];
        $tf_user = M('user');
        $data_user=$tf_user->where("id=%d",array($id))->select();
        //获取到总余额
        foreach ($data_user as $u){
            $zong=$u['money'];
            $zongf=$u['integral'];
        }
        if(!$zongf){
            $zongf=0;
        }
        $this->assign("zong",$zong);
        $this->assign("zongf",$zongf);
        $this->assign("page_title", "我的余额");
        $this->display();
    }
}