<?php
namespace Agent\Controller;

use Agent\Controller\BaseController;
use Think\Controller;

/**
 * 用户登录控制器
 * Created by PHPGROUP.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 11:50
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
        $this->assign("page_title", "代理商登录");
        $this->login();
    }

    /**
     * 登录
     */
    public function login() {
    	if ($this->isMobile()) {
                $this->assign("is_mobile", 1);
            }
	    
        if (IS_POST) {
            $username = I('post.username', '', 'trim');
            $password = I('post.password', '', 'trim');
            $verify = I('post.verify', '', 'trim');
            if ($username == "") {
                $this->assign('error', '用户名不能为空');
                $this->display();
                exit;
            }
            if ($password == "") {
                $this->assign('error', '密码不能为空');
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
            $model = M("user");
            $data['name'] = $username;
            $data['user_type'] = array('in','province_agent,city_agent,district_agent');
            $user = $model->where($data)->find();
            $sql = $model->getLastSql();

            if (empty($user)) {
                $this->assign('error', '用户不存在');
                $this->display();
                exit;
            }

            $_password = $user['pwd'];
            if (md5($password) !== $_password) {
                $this->assign('error', '密码不正确');
                $this->display();
                exit;
            }
            //账号是否冻结
            $user_status = $user['status'];
            if ($user_status=='disabled') {
                $this->assign('error','账号处于冻结状态，无法登陆');
                $this->display();
                exit;
            }

            //存储用户信息
            session('user_id', $user['id']);
            session('user_name', $user['name']);
            session('user_type', $user['user_type']);
            session('_user_real_name', $user['realname']);
            
            //判断送粉丝位时间是否过期
            $obj = M("user");
            $user_id = $user['id'];
            $now_time = time();//获取当前时间戳
            $now_month = date("m"); //获取当前月份
            //送粉丝位结束时间
            $fans_end_time = $obj->where("id=$user_id")->field("fans_end_time")->find();
            $fans_end_time = strtotime($fans_end_time['fans_end_time']);
            if($now_time > $fans_end_time){
                //更新数据
                $obj->month_fans = 0;
                $obj->where("id=$user_id")->save();
            }else{
                //判断粉丝位月份是否过期
                //查询登录者的粉丝位月份
                $before_month = $obj->where("id=$user_id")->field("month")->find();
                $before_month = date("m",strtotime($before_month['month']));
                if($before_month!=$now_month){
                    //查询每月粉丝位数量
                    $options = M("options");
                    $sql = "select `value` from tf_options WHERE `key`='month_fans_max'";
                    $month_fans_num = $options->query($sql);
                    $month_fans_num = $month_fans_num[0]['value'];
                    //更新数据
                    $obj->month = date("Y-m-d",time());
                    $obj->month_fans = $month_fans_num;
                    $obj->where("id = $user_id")->save();
                }
            }
    
            //记录登录时间
            $start = time();
            session("start", $start);
            $session_expire = C('SESSION_EXPIRE');
            session("expire", $start + $session_expire);
            $ref = session('redirect_url');
            if (is_null($ref)) {
                $ref = U('index/index');
            }
            redirect($ref);
        } else {
           /* if ($this->isLogin()) {
                $ref = session('redirect_url');
                $url = !empty($ref) ? $ref : U('index/index');
                redirect($url);
            }*/
            
            $this->display('login');
        }
    }

    /**
     * 注销
     */
    public function logout() {
        //清除会话
        session(null);
        $url = U('auth/login');
        redirect($url);
    }

    /**
     * 判断是否登录
     */
    private function isLogin() {
        $user_id = session('user_id');
        return empty($user_id) ? false : true;
    }
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
