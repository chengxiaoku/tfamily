<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class IndexController extends BaseController {
    public function index() {
        if (!empty(cookie('position') or !empty(cookie(('position_id'))))) {
            $position = cookie('position');
            $city_id = cookie('position_id');
        } else {
            cookie('position','洛阳市');
            cookie('position_id',189);
            $position = cookie('position');
            $city_id = cookie('position_id');
        }

        $new = M('news');
        $news = $new->order('add_time desc')->limit(0,3)->select();
        $new_count = $new->count();
        $this->assign('new_num',$new_count);
        $this->assign('new',$news);

        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        /*$city_id = $region_city[0]['region_id'];
        if ($city_id == '') {
            $city_id = 189;
        }*/
        $region_parent_id = $region_city[0]['parent_id'];
        $house = M('house');

        if ($region_parent_id==1) {
            $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,5)->select();
            $house_count = $house->where("province_id=$city_id")->count();
        } else {
            $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,5)->select();
            $house_count = $house->where("city_id=$city_id")->count();
        }
        foreach ($houses as $key=>$value) {
            $houses[$key]['price'] = intval($value['price']);
        }

        $this->assign('house_num',$house_count);
        $this->assign('house',$houses);

        $car = M('car');
        if ($region_parent_id==1) {
            $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,5)->select();
            $car_count = $car->where("province_id=$city_id")->count();
        } else {
            $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,5)->select();
            $car_count = $car->where("city_id=$city_id")->count();
        }

        foreach ($cars as $key=>$value) {
            $cars[$key]['price_max'] = intval($value['price_max']);
            $cars[$key]['price_min'] = intval($value['price_min']);
        }
        $this->assign('car_num',$car_count);
        $this->assign('car',$cars);

        $this->assign('position',$position);
        $this->assign("page_title", "T家园平台移动端首页");
        $this->display();
        
    }
    public function news_see_more() {
        $i = I('get.i');
        $new = M('news');
        $count = $new->count();
        if ($i >= $count){
            $news = $new->order('add_time desc')->limit(0,$count)->select();
        } else {
            $news = $new->order('add_time desc')->limit(0,$i)->select();
        }
        echo json_encode($news);
    }
    public function house_see_more() {
        $j = I('get.j');
        $house = M('house');

        /*$position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $city_id = $region_city[0]['region_id'];*/
        $city_id = cookie('position_id');

        $count = $house->where("city_id=$city_id")->count();
        if ($j >= $count){
            $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,$count)->select();
        } else {
            $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,$j)->select();
        }
        echo json_encode($houses);
    }
    public function car_see_more() {
        $k = I('get.k');
        $car = M('car');

        /*$position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $city_id = $region_city[0]['region_id'];*/
        $city_id = cookie('position_id');

        $count = $car->where("city_id=$city_id")->count();
        if ($k >= $count){
            $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$count)->select();
        } else {
            $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$k)->select();
        }
        echo json_encode($cars);
    }
}