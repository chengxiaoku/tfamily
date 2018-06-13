<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;

/**
 * 控制面板控制器
 * Class IndexController
 * @package Agent\Controller
 * @author xxx@qq.com
 * @date 2016-11-11
 */
class IndexController extends BaseController {

    public function index(){
        if ($this->isMobile()) {
            $this->mobile_index();

        } else {
            $user_data = $this->getUser();
            $user_id = $user_data['id'];
            $province_id = $user_data['province_id'];
            $city_id = $user_data['city_id'];
            $district_id = $user_data['district_id'];
            $user_money = $user_data['money'];
            $user_integral = $user_data['integral'];
            //我的会员
            $user = M("user");
            $user_count = $user->where("user_type='member' and parentid = $user_id")->count();
            $this->assign("user_count",$user_count);
            //我的团队
            $team = M("team");
            $team_count = $team->where("owner = $user_id")->count();
            $this->assign("team_count",$team_count);
            //我的粉丝
            $fan_count = $user->where("user_type = 'fan' and parentid=$user_id")->count();
            $this->assign("fan_count",$fan_count);
            //我的订单
            $order = M("orders");
            $order_count = $order->where("user_id=$user_id")->count();
            $this->assign("order_count",$order_count);
            //我的消息
            $notice = M("notices");
            $notice_count1 = $notice->where("userid=$user_id and type='one'")->count();
            $notice_count2 = $notice->where("type = 'all'")->count();
            $notice_count3 = $notice->where("((province_id=$province_id and city_id=0 and district_id=0) or (province_id=$province_id and city_id=$city_id and district_id=0) or (province_id=$province_id and city_id=$city_id and district_id=$district_id)) and type='range'")->count();
            $notice_count = $notice_count1+$notice_count2+$notice_count3;
            $this->assign("notice_count",$notice_count);
            //我的余额
            $this->assign("user_money",$user_money);
            $this->assign("user_integral",$user_integral);
            //楼盘统计
            $house = M('house');
            $house_count = $house->where("add_user_id = $user_id")->count();
            $this->assign("house_count",$house_count);
            $this->display();
        }

       

    }
    public function mobile_index(){
        $this->isMobile();
        $user=$this->getUser();
        $id=$user['id'];
        $obj = M('user');
        $level = M('level');
        $data = $obj->where("id=$id")->select();//数据集;
        foreach ($data as $d){
            $name=$d['name'];
            $level_id=$d['level_id'];
            $mone=$d['money'];
            $integral=$d['integral'];
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

        if($integral!=""){
            $this->assign('integray', $integral);
        }else{
            $this->assign('integray', 0);
        }
        $this->assign("page_title", "控制台");
        $this->display("mobile_index");
    }
   
}