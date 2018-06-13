<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

/**
 * 汽车展示控制器
 * Created by PhpStorm.
 * @User: LT
 * @Date: 2016/11/23
 * @Time: 23:37
 */
class CarController extends BaseController {
    public function index()
    {
        //汽车展示
        $car = M('car');
        $page_size = C("PAGE_SIZE");
        $this->assign('page_size',$page_size);
        
        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();

        $city_id = $region_city[0]['region_id'];
        if ($city_id == '') {
            $city_id = 189;
        }
        $region_parent_id = $region_city[0]['parent_id'];
        if ($region_parent_id==1){
            $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$page_size)->select();
            foreach ($cars as $key=>$value) {
                $cars[$key]['price_max'] = intval($value['price_max']);
                $cars[$key]['price_min'] = intval($value['price_min']);
            }
            $count = $car->where("province_id=$city_id")->count();
        }else{
            $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$page_size)->select();
            foreach ($cars as $key=>$value) {
                $cars[$key]['price_max'] = intval($value['price_max']);
                $cars[$key]['price_min'] = intval($value['price_min']);
            }
            $count = $car->where("city_id=$city_id")->count();
        }
        $this->assign("num",$count);
        $this->assign('car',$cars);

        //显示地区弹出框列表
        $position = cookie('position');
        $region = M('region');
        $regions = $region->where("region_name like '%$position%'")->select();
        $city_id = $regions[0]['region_id'];
        if ($city_id == '') {
            $city_id = 189;
        }
        $region_parent_id = $region_city[0]['parent_id'];
        
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

        //显示品牌弹出框列表
        $car_brand = C('CAR_BRAND');
        $car_brand = array(
            '0'=>$car_brand
        );
        $this->assign("car_brand",$car_brand);
        session("region_name",null);
        session("brand",null);
        $this->assign("page_title", "汽车展示");
        $this->display();

    }
    /*header("Content type:text/html;charset=utf-8");*/
    /*echo '<pre>';
    print_r($count);
    exit;*/
    //点击查看更多
    public function car_see_more() {
        $j = I('get.j');
        $reg = session("region_name");
        $brd = session("brand");
        $car = M('car');

        //获取tf_region表里的数值
        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $city_id = $region_city[0]['region_id'];
        $region_district_count = $region->where("region_name = '$reg' and parent_id = $city_id")->count();
	if($region_district_count==0){
	$region_district = $region->where("region_name = '$reg'")->select();
	}else{
	$region_district = $region->where("region_name = '$reg' and parent_id = $city_id")->select();
	}
        $district_id = $region_district[0]['region_id'];
        $region_parent_id = $region_city[0]['parent_id'];

        if ($region_parent_id==1){
            if ($reg == '' and  $brd == '' or ($brd == '不限' and $reg == '') or ($reg == '不限' and $brd == '') or ($brd == '不限' and $reg == '不限')) {
                $count = $car->where("province_id=$city_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            }else if ($reg != '' and $reg != '不限' and $brd == '' or ($brd == '不限' and $reg !== '')) {
                $count = $car->where("province_id=$city_id and district_id = $district_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            } else if ($brd != '' and $brd != '不限' and $reg == '' or ($reg == '不限' and $brd  !== '')) {
                $count = $car->where("province_id=$city_id and brand = $brd")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brd")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brd")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            } else if ($brd != '' and $brd != '不限' and $reg != '' and $reg != '不限') {
                $count = $car->where("province_id=$city_id and brand = '$brd' and district_id = $district_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brd and district_id = $district_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brd and district_id = $district_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            }
        }else{
            if ($reg == '' and  $brd == '' or ($brd == '不限' and $reg == '') or ($reg == '不限' and $brd == '') or ($brd == '不限' and $reg == '不限')) {
                $count = $car->where("city_id=$city_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            }else if ($reg != '' and $reg != '不限' and $brd == '' or ($brd == '不限' and $reg !== '')) {
                $count = $car->where("city_id=$city_id and district_id = $district_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            } else if ($brd != '' and $brd != '不限' and $reg == '' or ($reg == '不限' and $brd  !== '')) {
                $count = $car->where("city_id=$city_id and brand = $brd")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brd")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brd")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            } else if ($brd != '' and $brd != '不限' and $reg != '' and $reg != '不限') {
                $count = $car->where("city_id=$city_id and brand = '$brd' and district_id = $district_id")->count();
                if ($j >= $count){
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brd and district_id = $district_id")->limit(0,$count)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brd and district_id = $district_id")->limit(0,$j)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                }
                echo json_encode($cars);
            }
        }
    }


    public function region_type_select() {
        $page_size = C("PAGE_SIZE");
        $region_name = I('get.region');
        $brand = I('get.brand');

        if ($brand == '宝马') {
            $brand = '"bwm"' ;
        } else if ($brand == '大众') {
            $brand = '"das"' ;
        } else if ($brand == '本田') {
            $brand = '"honda"' ;
        } else if ($brand == '马自达') {
            $brand = '"maza"' ;
        } else if ($brand == '起亚') {
            $brand = '"kia"' ;
        } else if ($brand == '丰田') {
            $brand = '"toyota"' ;
        }else if ($brand == '斯柯达') {
            $brand = '"skoda"' ;
        } else if ($brand == '福特') {
            $brand = '"ford"' ;
        } else if ($brand == '别克') {
            $brand = '"buick"' ;
        } else if ($brand == '雪佛兰') {
            $brand = '"chevrolet"' ;
        } else if ($brand == '凯迪拉克') {
            $brand = '"cadillac"' ;
        }else if ($brand == '林肯') {
            $brand = '"lincoln"' ;
        } else if ($brand == '比亚迪') {
            $brand = '"byd"' ;
        } else if ($brand == '名爵') {
            $brand = '"mg"' ;
        } else if ($brand == '陆风') {
            $brand = '"lufeng"' ;
        } else if ($brand == '奔腾') {
            $brand = '"benteng"' ;
        }else if ($brand == '奇瑞') {
            $brand = '"qirui"' ;
        } else if ($brand == '长安') {
            $brand = '"changan"' ;
        } else if ($brand == '其他') {
            $brand = '"other"' ;
        }

        if (!empty($region_name)) {
            session("region_name",$region_name);
        }
        $region_name = empty($region_name)?session('region_name'):$region_name;
        if (!empty($brand)) {
            session("brand",$brand);
        }
        $brand = empty($brand)?session('brand'):$brand;

        $car = M('car');
        $position = cookie('position');
        $region = M('region');
        $region_city = $region->where("region_name like '%$position%'")->select();
        $city_id = $region_city[0]['region_id'];
      
        $region_district_count = $region->where("region_name = '$region_name' and parent_id = $city_id")->count();
	if($region_district_count==0){
	$region_district = $region->where("region_name = '$region_name'")->select();
	}else{
	$region_district = $region->where("region_name = '$region_name' and parent_id = $city_id")->select();
	}
        $district_id = $region_district[0]['region_id'];
        $region_parent_id = $region_city[0]['parent_id'];

        if ($region_parent_id==1){
            if ($region_name != '' and $brand == '') {
                if ($region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            } else if ($brand != '' and $region_name == '') {
                if ($brand == '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            } else if ($brand != '' and $region_name != '') {
                if ($brand == '不限' and $region_name != '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and district_id = $district_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand != '不限' and $region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand != '不限' and $region_name != '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id and district_id = $district_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand == '不限' and $region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("province_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            }
        }else{
            if ($region_name != '' and $brand == '') {
                if ($region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            } else if ($brand != '' and $region_name == '') {
                if ($brand == '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            } else if ($brand != '' and $region_name != '') {
                if ($brand == '不限' and $region_name != '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and district_id = $district_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand != '不限' and $region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand != '不限' and $region_name != '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id and district_id = $district_id and brand = $brand")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                } else if ($brand == '不限' and $region_name == '不限') {
                    $cars = $car->order('add_time desc')->where("city_id=$city_id")->limit(0,$page_size)->select();
                    foreach ($cars as $key=>$value) {
                        $cars[$key]['price_max'] = intval($value['price_max']);
                        $cars[$key]['price_min'] = intval($value['price_min']);
                    }
                    echo json_encode($cars);
                }
            }
        }

    }
    public function details() {
        $car=M('car');
        $id = $_GET['id'];//获取当前id
        $data = $car->where("id=$id")->find();//查询该数据
        $this->assign('list', $data);
        $img=$data['images'];//获取该数据图集
        $imgs=unserialize($img);

        if (!$imgs== null){
            foreach ($imgs as $i){
                $imag=$i['img'];
                $imags[]=array(img=>$imag);
            }
            $this->assign('imags', $imags);
        }else{
            $this->assign('imags', '');
        }

        //客服电话
        $leasts = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $this->assign('tel',$leasts);
        $this->assign("page_title", "汽车详情页");
        $this->display();
    }
    public function details_order() {
        //级别
        $CAR_SIZE = C('CAR_SIZE');
        $this->assign('CAR_SIZE', $CAR_SIZE);
        $user_id = session('_member_user_id');
        $suer_id2 = session('user_id');
        if (empty($user_id) and empty($suer_id2)) {
            session('redirect_url', $_SERVER['REQUEST_URI']);
            $url = U('Auth/login');
            redirect($url);
        }
        //获取当前车名
        $car=M('car');
        $id = $_GET['id'];
        $data = $car->where("id=$id")->find();
        $this->assign('list', $data);
        //车名
        $CAR_BRAND = C('CAR_BRAND');
        $this->assign('CAR_BRAND', $CAR_BRAND);
        //客服电话
        $leasts = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $this->assign('tel',$leasts);

        $this->assign("page_title", "汽车团购报名");
        $this->display();
    }
    public function details_order_add(){
        //提交添加
        $user_id = session('_member_user_id');
        if(empty($user_id)){
            $user_id = session('user_id');
        }
        
            //获取用户年龄、性别、省、市、区
            $user = M('user')->where("id=$user_id")->find();
            $this->assign('user',$user);
            $age = $user['age'];
            $sex = $user['sex'];
            $province = $user['province_id'];
            $city_id = $user['city_id'];
            $district_id = $user['district_id'];
            $car_id = isset($_POST['id']) ? $_POST['id'] : null;
            //获取数据
            $car_brand = isset($_POST['select1']) ? $_POST['select1'] : null;
            $select2 = isset($_POST['select2']) ? $_POST['select2'] : null;
            $like_car = isset($_POST['like_car']) ? $_POST['like_car'] : null;
            $car_market_price = isset($_POST['car_market_price']) ? $_POST['car_market_price'] : null;
            $car_my_price = isset($_POST['car_my_price']) ? $_POST['car_my_price'] : null;
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
            $message = isset($_POST['message']) ? $_POST['message'] : null;
            //移除字符串两侧字符
            $car_brand = trim($car_brand);
            $select2 = trim($select2);
            $like_car = trim($like_car);
            $car_market_price = trim($car_market_price);
            $car_my_price = trim($car_my_price);
            $name = trim($name);
            $tel = trim($tel);
            $message = trim($message);
            $order_type="auto";
            $status = 'pending';
            $sn = create_order_sn();
            //判断标题是否为空
            if (empty($car_brand)) {
                $this->error("非法操作：无汽车品牌参数");
            }
            if (empty($select2)) {
                $this->error("非法操作：无级别参数");
            }
            if (empty($like_car)) {
                $this->error("非法操作：无意向车型参数");
            }
            if (empty($car_market_price)) {
                $this->error("非法操作：无4s价格参数");
            }
            if (empty($car_my_price)) {
                $this->error("非法操作：无理想价格参数");
            }
            if (empty($name)) {
                $this->error("非法操作：无姓名参数");
            }
            if (empty($tel)) {
                $this->error("非法操作：无电话参数");
            }
            //获取汽车公司名、地址、品牌、汽车名称
            $cars = M('car')->where("id=$car_id")->select();
            $company_name = $cars['0']['company'];
            $company_addr = $cars['0']['address'];
            $car_brand= $cars['0']['brand'];
            $product_name= $cars['0']['title'];
            $data = array(
                "product_id" => $car_id,
                "product_name" => $product_name,
                "province" => $province,
                "city" => $city_id,
                "district"=>$district_id,
                "name" => $name,
                "tel" => $tel,
                "user_id" => $user_id,
                "sn"=> $sn,//号
                'message' => $message,
                "status" => $status,
                "sex"=>$sex,
                "age" => $age,
                'add_time' => date("Y-m-d H:i:s", time()),
                "order_type"=>$order_type,
                "car_brand" => $car_brand,
                "car_level" => $select2,
                "like_car" => $like_car,
                "car_market_price" => $car_market_price,
                "car_my_price" => $car_my_price,
                "car_company_name" => $company_name,
                "car_company_addr" => $company_addr
            );

            $orders = M("orders");
            $result = $orders->add($data);//插入数据
            //判断数据是否添加成功
            if ($result) {
                $this->details_order_success();
            } else {
                $this->details_order_error();
            }

    }
    public function details_order_success() {

      //客服电话
        $leasts = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $this->assign('tel',$leasts);

        $this->assign("page_title", "提交汽车团购表单成功提示页面");
        $this->display('details_order_success');
    }

    /*
        * 提交团购表单失败提示页面
        */
    public function details_order_error() {
        //客服电话
        $leasts = M('options')->where("`key`='service_hotline_one' or `key`='service_hotline_two'")->select();
        $this->assign('tel',$leasts);
    }

    //加载区域列表
    public function getAreaList()
    {
        $region = M('region');
        $city_id['parent_id'] = 189;
        $count = $region->where($city_id)->select();
        return $count;
    }



}