<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;

/**
 * 提现管理控制器
 * Created by PhpStorm.
 * User: 王天棋
 * Date: 2016/11/16
 * Time: 18:26
 */
class CashController extends BaseController {

    /**
     * 首页
     */
    public function index() {
        $user=$this->getUser();
        $id=$user['id'];
        $money=isset($_GET['money'])?$_GET['money']:'';
        //判断是否有银行卡
        $tf_bank = M('bank');
        $data_bank=$tf_bank->where("user_id=%d",array($id))->select();
        $tf_options = M('options');
        $data_options=$tf_options->select();
        foreach ($data_options as $op){
            if ($op['key']=='platform_service_fee'){
                $fuwu=$op['value'].'%';
                $fuwu2=intval($fuwu, 0)/100;
            }
            if ($op['key']=='cash_mini_money'){
                $mini=$op['value'];
            }
            if ($op['key']=='money_cash_date'){
                $data_time=$op['value'];
            }
        }
        $this->assign("t_time",$data_time);
        //传值判断显示的页面
        $q_time=explode(',',$data_time );
        $p_time=date('d',time());
        foreach ($q_time as $q){
            if ($p_time==$q){$this->assign("pd2",'yes_time');}
        }
        if ($data_bank){
            //传值判断显示的页面
            $this->assign("pd",'yes');
            $tf_user = M('user');
            $data_user=$tf_user->where("id=%d",array($id))->select();
            //获取到总余额
            foreach ($data_user as $u){
                $zong=$u['money'];
            }
        }
        //判断如果money有值进入数据库录入
        if ($money){
            $now_time=date('y-m-d h:i:s',time());
            $rel_money=$money-$money*$fuwu2;
            $do_type='cash';
            $status='pending';
            $tf_money_details = M('money_details');

            //判断money是否有值
            if (!$money){
                exit;
            }

            //判断余额是否足够
            if ($money>$zong){
                exit;
            }

            //判断money是否是500倍数
            $zhen=$money/$mini;
            if (!is_int($zhen)){
                exit;
            }

            //生存数组
            $data = array(
                'user_id' =>$id,
                'money' => $money,
                'real_money' => $rel_money,
                'do_type' => $do_type,
                'add_time' => $now_time,
                'status' => $status,
            );

            //获取剩下的余额
            $sheng=$zong-$money;

            //生存数组
            $data_new_money = array(
                "money" =>  $sheng,
            );
            //录入余额
            $tf_user->where("id=$id")->save($data_new_money);
            //录入申请
            $fanhui=$tf_money_details->data($data)->add();
            if (!$fanhui) {
                $this->error("提现失败", U('Cash/index'));
            } else {
                $this->success("提现成功", U('Money/index'));
            }
        } else {
            $this->assign("mini",$mini);
            //传入余额
            $this->assign("allmoney",$zong);
            //传入服务费
            $this->assign("fuwu",$fuwu);
            $this->assign("fuwu2",$fuwu2);

            $this->assign("page_title", "我要提现");
            $this->display();
        }

    }
}