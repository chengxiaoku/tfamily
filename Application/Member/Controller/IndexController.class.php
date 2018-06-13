<?php
namespace Member\Controller;
use Member\Controller\BaseController;

/**
 * 控制面板控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 21:50
 */
class IndexController extends BaseController {

    public function index(){
        $this->assign("page_title", "控制台");
	if ($this->isMobile()) {
		$this->mobile_index();
			
	} else {
		$this->display();
	}
        
    }
    public function mobile_index(){
        $this->isMobile();
        $user=$this->getUser();
        $id=$user['id'];
        $obj = M('user');
        $money = M('money_details');
        $level = M('level');
        $data = $obj->where("id=$id")->select();//数据集;
        $detail = $money->where("user_id=$id")->select();//数据集
        foreach ($data as $d){
            $name=$d['name'];
            $level_id=$d['level_id'];
        }
        foreach ($detail as $m){
            $mone=$m['money'];
            $integray=$m['integray'];
        }

        if($level_id!=""){
            $this->assign('level_id', $level_id);
        }else{
            $level_id=0;
        }
        if ($level_id ==0){
            $this->assign('description', 未知);
        }else {
            $level = $level->where("id=$level_id")->select();//数据集;
            foreach ($level as $l) {
                $description = $l['description'];
            }
            $this->assign('description', $description);
        }
        $this->assign('data', $name);
        if($mone!=""){
            $this->assign('mone',  $mone);
        }else{
            $this->assign('mone',  0);
        }

        if($integray!=""){
            $this->assign('integray', $integray);
        }else{
            $this->assign('integray', 0);
        }
        $this->assign("page_title", "控制台");
        $this->display("mobile_index");
    }
    public function member(){
        $this->assign("page_title", "我的会员");
        $this->display('member');
    }
    public function add() {
        $this->assign("page_title", "添加会员");
        $this->display('member-add');
    }
    /**
     * 绑定微信用户
     */
    public function weixin(){
        $this->assign('page_title','绑定微信');
        $this->display();
    }
}
