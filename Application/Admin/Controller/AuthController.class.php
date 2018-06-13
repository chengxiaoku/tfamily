<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 用户登录控制器
 * Created by PHPGROUP.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 11:50
 */
class AuthController extends Controller {

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
    public function login() {
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

            $model = M("admin");
            $user = $model->where(array('name'=>$username))->find();
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
            $lastDate = date("Y-m-d H:i:s");
            $lastIp = get_ip();
            //保存登录时间
            $model->where(array('id' => $user['id']))->data(array('last_time'=>$lastDate, 'last_ip'=>$lastIp))->save();
            //存储用户信息
            session('_admin_user_id', $user['id']);
            session('_admin_user_name', $user['name']);
            session('_admin_user_last_date', $user['last_time']);
            session('_admin_role_id', $user['role_id']);
            session('_admin_real_name', $user['realname']);
            session('_admin_is_super_admin', $user['is_super_admin']);
           
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
            if ($this->isLogin()) {
                $ref = session('redirect_url');
                $url = !empty($ref) ? $ref : U('index/index');
                redirect($url);
            }
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
        $user_id = session('_admin_user_id');
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
}
