<?php
namespace Home\Controller;
use Home\Controller\BaseController;

/**
 * 登陆控制器
 * Class AuthController
 * @package Home\Controller
 * @author 1336206540@qq.com  王俊璐
 * @date 2016-11-24
 */

class AuthController extends BaseController{
    //登陆跳转
    public function login(){
        
        $this->display();
    }

    //异步判断用户是否登录
    public function logins(){
        //判断是否有用户登陆
        $agent_user = session('user_id');
        $member_user = session('_member_user_id');
        if (empty($member_user) and empty($agent_user)) {
            $this->ajaxReturn(0);
        } else {
            $this->ajaxReturn(1);
        }
    }

    /**
     * 注销
     */
    public function logout() {
        //获取原地址
        $curl = I('get.curl');
        $aurl = I('get.aurl');
        //清除会话
        session(null);
        $url = U("$curl/$aurl");
        redirect($url);
    }
}