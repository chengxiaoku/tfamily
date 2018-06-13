<?php

namespace Member\Controller;
use Think\Controller;

/**
 * T会员登录控制器
 * Created by PhpStorm.
 * User: 王俊璐 1336206540@qq.com
 * Date: 2016/11/17
 * Time: 13:57
 * Description: 描述
 */

class AuthController extends Controller{
    /**
     * 初始化函数
     * (non-PHPdoc)
     * @see Controller::_initialize()
     */
    protected function _initialize() {
        define('ASSETS', './Public/assets/');
        $site_name = C("SITE_NAME");
        $this->assign('site_title', $site_name);
    }

    /**
     * 默认
     */
    public function index() {
        $this->login();
    }

    /**
     * 登录
     */
    public function login () {
        if (IS_POST) {
            //过滤空字符
            $username = I("post.username","","trim");
            $passpwd = I("post.password","","trim");
            $verify = I('post.verify', '', 'trim');
            if($username == "") {
                $this->assign('error','会员名称不能为空');
                $this->display();
                exit;
            }
            if($passpwd == "") {
                $this->assign('error','密码不能为空');
                $this->display();
                exit;
            }
            if ($verify == "") {
                $this->assign('error', '验证码不能为空');
                $this->display();
                exit;
            }
            //检测验证码
            $verifyObject = new \Think\Verify();
            if (!$verifyObject->check($verify, 'login')) {
                $this->assign('error', '输入验证码有误');
                $this->display();
                exit;
            }

            //连接数据库，判断用户是否存在
            $model = M('user');
            $user = $model->where(array('name'=>$username,'user_type'=>'member'))->find();
            if (empty($user)) {
                $this->assign('error','该会员不存在');
                $this->display();
                exit;
            }
            $userpwd = $user['pwd'];
            if (md5($passpwd)!=$userpwd) {
                $this->assign('error','密码不正确');
                $this->display();
                exit;
            }

            //验证完毕，保存用户数据
            session('_member_user_id',$user['id']);             //会员id
            session('_member_user_name',$user['name']);         //会员名称
            session('_member_user_realname',$user['real_name']);//会员真实姓名

            //登录过期时间
            $start = time();                                    //登录时间
            session('start_time',$start);
            $session_expire = C('SESSION_EXPIRE');              //登录持续时间
            $exit_time = $start + $session_expire;               //清除登录时间
            session('exit_time',$exit_time);

            //获取上一次操作的网页，如果有记录则跳转至，如果没有则跳转登录页
            $ref = U('index/index');
            redirect($ref);

        }else{
            //判断是否登录
           /* if($this->isLogin()){
                $ref = session('redirect_url');
                $url = !empty($ref) ? $ref : U('index/index');
                redirect($url);
            }*/
            if ($this->isMobile()) {
                $this->assign("is_mobile", 1);
            }
            $this->display();
        }
    }


    /**
     *注销登录
     */
    public function logout(){
        session(null);                                  //清空session
        $url = U('auth/login');
        redirect($url);                                 //跳转至登录页
    }

    /**
     *判断是否登录
     */
   /* public function isLogin(){
        $user_id = session('_member_user_id');          //判断id还存在不
        return empty($user_id) ? false : true;
    }*/
    /**
     * 生成验证码
     */
    public function verify() {
        ob_clean();
        //import("ORG.Util.Think.Image");
        $verify = new \Think\Verify();
        $verify->codeSet = '0123456789';
        $verify->imageW = 100;
        $verify->imageH = 35;
        $verify->fontSize = 18;
        $verify->length = 4;
        $verify->entry('login');
    }

    /**
     * 检测客户端是否是移动端
     */
    public function isMobile() {
        //导入平台检测类
        import("Common.Vendor.Mobile_Detect", APP_PATH, '.php');
        $detect = new \Mobile_Detect();
        return $detect->isMobile();
    }

}