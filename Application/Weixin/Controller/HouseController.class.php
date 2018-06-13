<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

/**
 * 房屋详情
 * Created by PhpStorm.
 * User: yzq&lzp
 * Date: 2016/11/21
 * Time: 08：00
 * Description: -ing
 */
class HouseController extends BaseController {
    public function index() {
        $house = M('house');

        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $region_parent_id = $region_city[0]['parent_id'];
        $city_id = cookie('position_id');

        if ($region_parent_id==1) {
            $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,10)->select();
            $count = $house->where("province_id=$city_id")->count();
        } else {
            $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,10)->select();
            $count = $house->where("city_id=$city_id")->count();
        }
        foreach ($houses as $key=>$value) {
            $houses[$key]['price'] = intval($value['price']);
        }
        $this->assign("num",$count);
        $this->assign('house',$houses);

        $region = M('region');
        /*$position = cookie('position');
        $regions = $region->where("region_name like '%$position%'")->select();
        $city_id = $regions[0]['region_id'];*/
        $city_id = cookie('position_id');

        if ($region_parent_id==1){
            $regions_cityid=$region->where("parent_id=$city_id")->select();
            $city_id_first = $regions_cityid[0]['region_id'];
            $city_id_two =$regions_cityid[1]['region_id'];
            $condition['parent_id'] = array('in',array($city_id_first,$city_id_two));
            $district=$region->where($condition)->select();
        }else{
            $district = $region->where("parent_id=$city_id")->select();
        }
        $this->assign("district",$district);

        $house_type = C('HOUSE_TYPE');
        $house_type = array(
            '0'=>$house_type
        );
        $this->assign("house_type",$house_type);

        $this->assign("page_title", "楼盘列表页");
        session("region_name",null);
        session("room",null);
        $this->display();
    }
    
    
    public function house_see_more() {
        $j = I('get.j');
        $reg = session("region_name");
        $rom = session("room");
        $house = M('house');

        $city_id = cookie('position_id');
        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $region_parent_id = $region_city[0]['parent_id'];

        if ($region_parent_id==1) {
            $regions_cityid=$region->where("parent_id=$city_id")->select();
            $city_id_first = $regions_cityid[0]['region_id'];
            $city_id_two =$regions_cityid[1]['region_id'];
            $region_district = $region->where("region_name = '$reg' and parent_id in($city_id_first,$city_id_two)")->select();
            $district_id = $region_district[0]['region_id'];
        } else {
            $region_district = $region->where("region_name = '$reg' and parent_id = $city_id")->select();
            $district_id = $region_district[0]['region_id'];
        }

        if ($district_id == '') {
            $district_id = 1907;
        }
        if ($region_parent_id == 1) {
            if ($reg == '' and  $rom == '' or ($rom == '不限' and $reg == '') or ($reg == '不限' and $rom == '') or ($rom == '不限' and $reg == '不限')) {
                $count = $house->where("city_id=$city_id")->count();
                if ($j >= $count){
                    $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,$count)->select();
                } else {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,$j)->select();
                }
                echo json_encode($houses);
            } else if ($reg != '' and $reg != '不限' and $rom == '') {
                $count = $house->where("province_id=$city_id and district_id = $district_id")->count();
                if ($j >= $count){
                    $houses = $house->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$count)->select();
                } else {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$j)->select();
                }
                echo json_encode($houses);
            } else if ($rom != '' and $rom != '不限' and $reg == '') {
                $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC ";
                $num = $house->query($sql);
                $count = count($num);
                if ($j >= $count){
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC  limit 0,$count ";
                    $houses = $house->query($sql);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC  limit 0,$j";
                    $houses = $house->query($sql);
                }
                echo json_encode($houses);
            } else if ($rom != '' and $rom != '不限' and $reg != '' and $reg != '不限') {
                $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC ";
                $num = $house->query($sql);
                $count = count($num);
                if ($j >= $count){
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC limit 0,$count";
                    $houses = $house->query($sql);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC limit 0,$j";
                    $houses = $house->query($sql);
                }
                echo json_encode($houses);
            }

        } else {
            if ($reg == '' and  $rom == '' or ($rom == '不限' and $reg == '') or ($reg == '不限' and $rom == '') or ($rom == '不限' and $reg == '不限')) {
                $count = $house->where("city_id=$city_id")->count();
                if ($j >= $count){
                    $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,$count)->select();
                } else {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,$j)->select();
                }
                echo json_encode($houses);
            } else if ($reg != '' and $reg != '不限' and $rom == '') {
                $count = $house->where("city_id=$city_id and district_id = $district_id")->count();
                if ($j >= $count){
                    $houses = $house->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$count)->select();
                } else {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$j)->select();
                }
                echo json_encode($houses);
            } else if ($rom != '' and $rom != '不限' and $reg == '') {
                $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC ";
                $num = $house->query($sql);
                $count = count($num);
                if ($j >= $count){
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC  limit 0,$count ";
                    $houses = $house->query($sql);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom GROUP BY house.id order by house.add_time DESC  limit 0,$j";
                    $houses = $house->query($sql);
                }
                echo json_encode($houses);
            } else if ($rom != '' and $rom != '不限' and $reg != '' and $reg != '不限') {
                $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC ";
                $num = $house->query($sql);
                $count = count($num);
                if ($j >= $count){
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC limit 0,$count";
                    $houses = $house->query($sql);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $rom AND house.district_id = $district_id GROUP BY house.id order by house.add_time DESC limit 0,$j";
                    $houses = $house->query($sql);
                }
                echo json_encode($houses);
            }
        }

    }

    public function region_type_select() {
        $region_name = I('get.region');
        $room = I('get.room');

        if ($room == '一室') {
            $room = 1 ;
        } else if ($room == '二室') {
            $room = 2 ;
        } else if ($room == '三室') {
            $room = 3 ;
        } else if ($room == '四室') {
            $room = 4 ;
        } else if ($room == '五室') {
            $room = 5 ;
        } else if ($room == '六室') {
            $room = 6 ;
        }

        if (!empty($region_name)) {
            session("region_name",$region_name);
        }
        $region_name = empty($region_name)?session('region_name'):$region_name;
        if (!empty($room)) {
            session("room",$room);
        }
        $room = empty($room)?session('room'):$room;

        $city_id = cookie('position_id');

        $house = M('house');
        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $region_parent_id = $region_city[0]['parent_id'];

        if ($region_parent_id==1) {
            $regions_cityid=$region->where("parent_id=$city_id")->select();
            $city_id_first = $regions_cityid[0]['region_id'];
            $city_id_two =$regions_cityid[1]['region_id'];
            $region_district = $region->where("region_name = '$region_name' and parent_id in($city_id_first,$city_id_two)")->select();
            $district_id = $region_district[0]['region_id'];
        } else {
            $region_district = $region->where("region_name = '$region_name' and parent_id = $city_id")->select();
            $district_id = $region_district[0]['region_id'];
        }

        if ($district_id == '') {
            $district_id = 1907;
        }
        if ($region_parent_id==1) {
            if ($region_name != '' and $room == '') {
                if ($region_name == '不限') {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,10)->select();
                    echo json_encode($houses);
                }
            } else if ($room != '' and $region_name == '') {
                if ($room == '不限') {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as house_type ON house.id = house_type.house_id where house.province_id = $city_id AND house_type.room = $room GROUP BY house.id order by house.add_time DESC limit 0,10";
                    $houses = M()->query($sql);
                    echo json_encode($houses);
                }
            } else if ($room != '' and $region_name != '') {
                if ($room == '不限' and $region_name != '不限') {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else if ($room != '不限' and $region_name == '不限') {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $room GROUP BY house.id order by house.add_time DESC  limit 0,10";
                    $houses = $house->query($sql);
                    echo json_encode($houses);
                } else if ($room != '不限' and $region_name != '不限') {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.province_id = $city_id AND type.room = $room AND district_id = $district_id GROUP BY house.id order by house.add_time DESC  limit 0,10";
                    $houses = $house->query($sql);
                    echo json_encode($houses);
                } else if ($room == '不限' and $region_name == '不限') {
                    $houses = $house->order('add_time desc')->where("province_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                }
            }
        } else {
            if ($region_name != '' and $room == '') {
                if ($region_name == '不限') {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,10)->select();
                    echo json_encode($houses);
                }
            } else if ($room != '' and $region_name == '') {
                if ($room == '不限') {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as house_type ON house.id = house_type.house_id where house.city_id = $city_id AND house_type.room = $room GROUP BY house.id order by house.add_time DESC limit 0,10";
                    $houses = M()->query($sql);
                    echo json_encode($houses);
                }
            } else if ($room != '' and $region_name != '') {
                if ($room == '不限' and $region_name != '不限') {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,10)->select();
                    echo json_encode($houses);
                } else if ($room != '不限' and $region_name == '不限') {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $room GROUP BY house.id order by house.add_time DESC  limit 0,10";
                    $houses = $house->query($sql);
                    echo json_encode($houses);
                } else if ($room != '不限' and $region_name != '不限') {
                    $sql ="select house.title, house.id,house.thumb,house.price,house.summary FROM tf_house as house LEFT JOIN tf_house_type as type ON house.id = type.house_id where house.city_id = $city_id AND type.room = $room AND district_id = $district_id GROUP BY house.id order by house.add_time DESC  limit 0,10";
                    $houses = $house->query($sql);
                    echo json_encode($houses);
                } else if ($room == '不限' and $region_name == '不限') {
                    $houses = $house->order('add_time desc')->where("city_id=$city_id")->limit(0,10)->select();
                    echo json_encode($houses);
                }
            }
        }

    }
    /*
     * 楼盘详情页面
     */
    public function details() {
        $id= I('get.id',"1");
        $type = M('house_type')->where("house_id=$id")->select();
        $date = M('house')->where("id=$id")->select();
        $tel = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $_data = $date[0]['images'];
        $data = unserialize($_data);
        $img = array();
        $i = 1;
        foreach ($data as $val_1){
            if(is_array($val_1)){
                foreach ($val_1['images'] as $val_2){
                    if(!empty($val_2)){
                        $img[$i][]=$val_2;
                    }
                }
            }
            $i++;
        }
        $this->assign('tel',$tel);
        $this->assign('img',$img);
        $this->assign('date',$date);
        $this->assign('type',$type);
        $this->assign('id',$id);
        $this->assign("page_title", "楼盘详情");
        $this->display();
    }
    /*
     * 订单页面
     */
    public function details_order() {
        $member_user_id = session('_member_user_id');
        $agent_user_id = session('user_id');
        if (empty($member_user_id) and empty($agent_user_id)) {
            session('redirect_url', $_SERVER['REQUEST_URI']);
            $url = U('auth/login');
            redirect($url);
        }
        $data = M('house_type');
        $tel = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $price = M('house')->where("id=$house_id")->select();
        $date = $data->where("house_id=$house_id")->select();
        $this->assign('tel',$tel);
        $this->assign('date',$date);
        $this->assign('price',$price);
        $this->assign("page_title", "楼盘团购报名");
        $this->display();
    }
    /*
     * 订单处理
     */
    public function details_form() {
        $user_id = session('_member_user_id');
        if(empty($user_id)){
            $user_id = session('user_id');
        }
        //获取用户年龄,性别,地址
        $user = M('user')->where("id=$user_id")->select();
        $age = $user['0']['age'];
        $sex = $user['0']['sex'];
        $province = $user['0']['province'];
        $city = $user['0']['city'];
        $district = $user['0']['district'];
        //默认的订单类型和审核状态
        $sn = create_order_sn();
        $order_type = "house";
        $product_name = "";
        $status = "pending";
        //获取表单的值
        $title = I('post.title');
        $my_type = I('post.my_type');
        $area = I('post.my_area');
        $type = I('post.type');
        $name = I('post.name');
        $tel= I('post.tel');
        $price= I('post.price');
        $message = I('post.message');
        $builder_name = I('post.builder_name');
        $my_price = I('post.my_price');
        $sale_address = I('post.sale_address');
        //插入数组
        $date['sn'] = $sn;
        $date['name'] = $name;
        $date['user_id'] = $user_id;
        $date['tel'] = $tel;
        $date['age'] = $age;
        $date['sex'] = $sex;
        $date['house_type'] = $type;
        $date['house_market_price'] = $price; //市场价格
        $date['house_my_price'] = $my_price;    //理想价格
        $date['house_my_area'] = $area;     //理想面积
        $date['house_my_type'] = $my_type;     //理想户型
        $date['house_company'] = $builder_name;     //楼盘开发商
        $date['house_address'] = $sale_address;     //售楼地址
        $date['house_name'] = $title;     //楼盘名称
        $date['message'] = $message;
        $date['order_type'] = $order_type;
        $date['product_name'] = $title;     //订单名称=楼盘名称
        $date['add_time'] = date("Y-m-d H:i:s",time());
        $date['province'] = 19;//$province;
        $date['city'] = 231;//$city;
        $date['district'] = 2306;//$district;
        $date['status'] = $status;
        $rs = M('orders')->add($date);
        if($rs){
            $this->details_order_success();
        } else {
            $this->details_order_error();
        }
    }
    /*
     * 提交团购表单失败提示页面
     */
    public function details_order_error() {
    	$tel = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
	$this->assign('tel',$tel);
        $this->assign("page_title", "提交团购表单失败提示页面");
        $this->display('details_order_error');
    }
    /*
    * 提交团购表单成功提示页面
    */
    public function details_order_success() {
    	$tel = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
	$this->assign('tel',$tel);
        $this->assign("page_title", "提交团购表单成功提示页面");
        $this->display('details_order_success');
    }
}