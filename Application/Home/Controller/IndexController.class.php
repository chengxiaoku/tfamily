<?php
namespace Home\Controller;
use Home\Controller\BaseController;

/**
 * 网站首页控制器
 * Class IndexController
 * @package Home\Controller
 * @author 1336206540@qq.com  王俊璐
 * @date 2016-11-21
 */

class IndexController extends BaseController {
    //网站首页
    public function index(){
        //最新楼盘
        $house = M('house');
	    $new_house = $house->order('add_time asc')->limit(4)->select();             //最新楼盘搜索
	    $hot_house = $house->where('is_hot = 1')->limit(4)->select();                 //最热楼盘搜索
	    $ads = M('ads')->where('id=3')->field('ad_content')->select();
	    $ads = $ads[0]['ad_content'];
	    $ads = unserialize($ads);


	    //定位
	    $city_id = cookie('city_id');
	    $region = M('region');
	    $city_name = $region->where("region_id=$city_id")->field('region_name')->select();
	    $city_name = $city_name[0]['region_name'];                          //获取所在城市放在首页

            $this->assign('img',$ads);
	    $this->assign('city_id',$city_id);                                  //用于给选中城市加样式
	    $this->assign('city_name',$city_name);
	    $this->assign('new_house',$new_house);              //最新楼盘数据
	    $this->assign('hot_house',$hot_house);              //最热楼盘数据
	    $this->assign('page_title','T家园创业平台首页');
	    $this->display();
        
    }
    
    //异步拉取省市区
    public function region(){
            $province = I('post.provice_id','','trim');             //获取省id
            $city = I('post.city_id','','trim');                    //获取城市id
            if ($province==1) {
                $provinces = C('OPEN_CITY');
                $this->ajaxReturn($provinces);
                exit;
            }
            if($city!=''){
                cookie('city_id',$city);                            //城市id存入cookie
                $city_name = M('region')->where("region_id=$city")->field('region_name')->select();
                cookie('city_name',$city_name);                            //城市名称存入cookie
                exit;
            }
    }


    public function qrcode($user_id) {
        if (is_null($user_id)) {
            $user_id = $_GET['user_id'];
        }
        import('Common.Vendor.phpqrcode.phpqrcode',APP_PATH, '.php');
        $id=$user_id;
        $qian=$_SERVER['HTTP_HOST'];
        $url='http://tjy518.com/index.php?m=home&c=referee&a=index&ref='.$id;
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "6"; // 点的大小：1到10
        \QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);
    }




    
}