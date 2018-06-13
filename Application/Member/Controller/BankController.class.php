<?php
/**
 * 我的银行卡
 * Created by PhpStorm.
 * User: lzp
 * Date: 2016/11/17
 * Time: 9:32
 * Description:我的银行卡
 */

namespace Member\Controller;
use Member\Controller\BaseController;
use Think\Model;

class BankController extends BaseController {
    /*
     * 默认控制器
     */
    public function index() {
        $user = $this->getUser();
        $user_id = $user['id'];
        $date = M("bank")->where("user_id=$user_id")->select();
        if(empty($date)){
            $this->bank_none();
        } else {
            $this->bank_info();
        }
    }
    /*
     * 账户信息
     */
    public function bank_info() {
        $user = $this->getUser();
        $user_id = $user['id'];
        $date = M("bank")->where("user_id=$user_id")->field("bank_name,bank_account,bank_user")->select();
        $this->assign('date',$date);
        $this->assign("page_title","我的银行卡");
        $this->display("mybank_index");
    }
    /*
     * 绑定银行卡
     */
    public function bank_none() {
        $this->assign("page_title","我的银行卡");
        $this->display("mybank_none");
    }
    /*
     * 添加账户信息页面
     */
    public function bank_add() {
        $this->assign("page_title","我的银行卡");
        $this->display("mybank_add");
    }
    /*
     * 修改账户信息
     */
    public function bank_update() {
        $user = $this->getUser();
        $user_id = $user['id'];
        $date = M("bank")->where("user_id=$user_id")->field("bank_name,bank_account,bank_user")->select();
        $this->assign('date',$date);
        $this->assign("page_title","我的银行卡");
        $this->display("mybank_update");
    }
    /*
     * 修改账户信息操作
     */
    public function bank_do_update() {
        $user = $this->getUser();
        $user_id = $user['id'];
        $bank = I("post.bank","","trim");
        $user = I("post.user","","trim");
        $account = I("post.account","","trim");
        //判断银行卡账户是否修改
        $arr = M('bank')->where("user_id=$user_id and bank_account='$account'")->select();
        $arr = count($arr);
        if($arr==1){
            $date['bank_name'] = $bank;
            $date['bank_user'] = $user;
            $date['bank_account'] = $account;
            $rs = M('bank')->where("user_id=$user_id")->save($date);
            if($rs){
                $this->success("更改银行卡信息成功",U('bank/index'));
            } else {
                $this->error("更改银行卡信息失败");
            }
        }
        //判断账户是否存在
        if($arr==0){
            $arr = M('bank')->where("bank_account='$account'")->select();
            $arr = count($arr);
            if($arr==0){
                $date['bank_name'] = $bank;
                $date['bank_user'] = $user;
                $date['bank_account'] = $account;
                $rs = M('bank')->where("user_id=$user_id")->save($date);
                if($rs){
                    $this->success("更改银行卡信息成功",U('bank/index'));
                } else {
                    $this->error("更改银行卡信息失败");
                }
            } else {
                $info = "该银行卡已存在！";
                $this->error("$info");
            }
        }
    }
    /*
     * 添加账户操作
     */
    public function bank_do_add() {
        $user = $this->getUser();
        $user_id = $user['id'];

        $bank = I("post.bank","","trim");
        $user = I("post.user","","trim");
        $account = I("post.account","","trim");
        //判断银行卡账户是否已存在
        $arr = M('bank')->where("bank_account='$account'")->select();
        $arr = count($arr);
        if($arr==0){
            $date['bank_name'] = $bank;
            $date['bank_user'] = $user;
            $date['bank_account'] = $account;
            $date['user_id'] = $user_id;
            $date['add_time'] = date("Y-m-d H:i:s",time());
            $rs = M('bank')->add($date);
            if($rs){
                $this->success("绑定银行卡成功",U('bank/index'));
            } else {
                $this->error("绑定银行卡失败，请确认输入信息是否有误");
            }
        } else {
            $info = "该银行卡已存在！";
            $this->error("$info");
        }
    }
    /*
     * 删除银行卡信息
     */
    public function bank_del() {
        $user = $this->getUser();
        $user_id = $user['id'];
        $date = M('bank')->where("user_id=$user_id")->delete();
        if($date) {
            $this->success("删除银行卡成功",U('bank/index'));
        } else {
            $this->error("删除银行卡失败",U('bank/index'));
        }
    }
}