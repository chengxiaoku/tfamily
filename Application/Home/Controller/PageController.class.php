<?php
namespace Home\Controller;
use Home\Controller\BaseController;

/**
 * 网页底部连接控制器
 * Class FootController
 * @package Home\Controller
 * @author 1336206540@qq.com  王俊璐
 * @date 2016-11-21
 */
class PageController extends BaseController{
    //帮助中心
    public function help(){
        $db = M("category");
        $rows = $db->where('name="帮助中心"')->select();
        $this->assign("rows",$rows);
        $this->assign('page_title','帮助中心');
        $this->display();
    }

    //关于我们
    public function aboutus(){
        $db = M("category");
        $rows = $db->where('name="关于我们"')->select();
        $this->assign("rows",$rows);
        $this->assign("page_title",'关于我们');
        $this->display();
    }
    public function contactus(){
        $db = M("category");
        $rows = $db->where('name="联系我们"')->select();
        $this->assign("rows",$rows);
        $this->assign("page_title",'联系我们');
        $this->display();
    }
    public function joinus(){
        $db = M("category");
        $rows = $db->where('name="加入我们"')->select();
        $this->assign("rows",$rows);
        $this->assign("page_title",'加入我们');
        $this->display();
    }
    public function privacynotice(){
        $db = M("category");
        $rows = $db->where('name="隐私声明"')->select();
        $this->assign("rows",$rows);
        $this->assign("page_title",'隐私声明');
        $this->display();
    }

    //抱团砍价
    public function bargain(){
        $db = M("category");
        $rows = $db->where('name="抱团砍价"')->select();
        $this->assign("rows",$rows);
        $this->assign('page_title','抱团砍价');
        $this->display();
    }

     //就业创业
    public function entrepreneurship(){
        $db = M("category");
        $rows = $db->where('name="就业创业"')->select();
        $this->assign("rows",$rows);
        $this->assign('page_title','就业创业');
        $this->display();
    }

    //赚钱省钱
    public function make_money(){
        $db = M("category");
        $rows = $db->where('name="赚钱省钱"')->select();
        $this->assign("rows",$rows);
        $this->assign('page_title','赚钱省钱');
        $this->display();
    }

    //专车接送
    public function service(){
        $db = M("category");
        $rows = $db->where('name="专车接送"')->select();
        $this->assign("rows",$rows);
        $this->assign('page_title','专车接送');
        $this->display();
    }
}