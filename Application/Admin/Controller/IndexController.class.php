<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;

/**
 * 控制面板控制器
 * Class IndexController
 * @package Admin\Controller
 * @author xxx@qq.com
 * @date 2016-11-11
 */
class IndexController extends BaseController {

    /**
     * 首页
     */
    public function index() {
        /*$url = U('Admin/User/province_agent');
        redirect($url);*/
        //用户统计
        $user = M("user");
        //代理商
        $agent_count = $user->where("user_type = 'province_agent' or user_type = 'district_agent' or user_type = 'city_agent'")->count();
        $this->assign("agent_count",$agent_count);
        //会员
        $member_count = $user->where("user_type = 'member'")->count();
        $this->assign("member_count",$member_count);
        //粉丝
        $fan_count = $user->where("user_type = 'fan'")->count();
        $this->assign("fan_count",$fan_count);
        //楼盘统计
        $house = M("house");
        $house_count = $house->count();
        $this->assign("house_count",$house_count);
        //汽车统计
        $car = M("car");
        $car_count = $car->count();
        $this->assign("car_count",$car_count);
        //订单统计
        $orders = M("orders");
        $orders_count = $orders->count();
        $this->assign("order_count",$orders_count);
        //新闻统计
        $news = M("news");
        $news_count = $news->count();
        $this->assign("news_count",$news_count);
        //广告统计
        $ad = M('adspace');
        $ad_count = $ad->count();
        $this->assign("ad_count",$ad_count);
        //财务统计
        $money = M('money_details');
        $money_count = $money->count();
        $this->assign("money_count",$money_count);
        $this->assign("pagea_title","控制台");
        $this->display();
    }

}