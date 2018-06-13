<?php
namespace Home\Controller;
use Home\Controller\BaseController;

/**
 * 新房控制器
 * Class IndexController
 * @package Home\Controller
 * @author 1336206540@qq.com  王俊璐
 * @date 2016-11-21
 */

class HouseController extends BaseController{
    //房屋列表
    public function index(){
        
        //将点击搜索条件cookie全部清空
        cookie('ss',null);
        cookie('px',null);
        cookie('qy',null);
        cookie('min_price',null);
        cookie('max_price',null);
        cookie('lx',null);
        cookie('hx',null);


        //区域搜索显示
        $city_id = cookie('city_id');
        $region = M('region');
        //检索所有所在城市下的区
        $districe = $region->where("parent_id = $city_id")->field('region_name,region_id')->select();


        //显示楼盘数据

        $data = M()->table('tf_house as hs')->limit(5)->join('tf_house_type as hst on hs.id = hst.house_id','LEFT')->field('hs.*,hst.house_id,hst.room,hst.hall,hst.toilet')->group('hst.house_id')->select();

        //获取房屋户型、类型
        $house_mold = C('lp_type');
        $house_type = C('HOUSE_TYPE');
        unset($house_type['other']);                //去掉不限

        $this->assign('districe',$districe);        //县区数据
        $this->assign('loading','加载更多');        //查看更多
        $this->assign('data',$data);                //获取5条数据传到列表页
        $this->assign('house_mold',$house_mold);    //房屋类型
        $this->assign('house_type',$house_type);    //房屋户型
        $this->assign('page_title','楼盘列表');
        $this->display();
    }

    //房屋详情
    public function house_detail(){
        $this->assign('page_title','楼盘详情页');
        $house=M('house');
        $id=$_GET['id'];
        if($id==''){
            $id=1;
        }
        //咨询电话
        $tel = M('options')->where('id=7')->select();
        $tel = $tel[0]['value'];

        $detail=$house->where("`id`=$id")->select();
        $rec=$house->where("is_recommended=1")->limit(4)->select();
        $this->assign('rec',$rec);
        $this->assign('detail',$detail[0]);
        $house_type=M('house_type');
        $type=$house_type->where("house_id=$id")->select();
        $typecount=$house_type->where("house_id=$id")->count();
        $this->assign('type',$type);
        $this->assign('type2',$type);
        $this->assign('count',$typecount);
        $img=$detail[0]['images'];
        $img=unserialize($img);
        $img=$img[0]['images'][0];
        $this->assign('tel',$tel);
        $this->assign('img',$img);
        $this->assign("id",$id);
	$this->display();
    }
    
    //楼盘订单
    public function orders() {
        $user_id=session('_member_user_id')+session('user_id');
        $data = array(
            'user_id'=> $user_id,
            'product_id' => $_GET['id'],
            'house_name' => $_POST['title'],
            'product_name' =>'房屋订单',
            'name' => $_POST['realname'],
            'tel'=>$_POST['tel'],
            'house_my_area'=>$_POST['mj'],
            'house_my_type'=>$_POST['hx'],
            'house_market_price'=>$_POST['price'],
            'house_my_price'=>$_POST['lxprice'],
            'message'=>$_POST['beizu'],
            'order_type'=>'house',
	    'add_time'=>date('Y-m-d H-i-s',time())
            
        );
        $orders=M('orders');
        $rs=$orders->data($data)->add();
        if ($rs) {
            $this->success("参团成功");
        } else {
            $this->error("参团失败");
        }
    }
    

    //楼盘相册
    public function house_photo(){
        $this->assign('page_title','楼盘详情');
        $house=M('house');
        $id=$_GET['id'];
        $detail=$house->where("`id`=$id")->select();
        $this->assign('detail',$detail[0]);
        $img=$detail[0]['images'];
        $img=unserialize($img);
        $this->assign('img',$img[0]['images']);

        $this->display();
    }



    //搜索楼盘
    public function house_select(){
        if (!IS_POST) {
            $this->error('页面不存在',U('index/index'));
        } else {
            //加载网页
            //如果搜索数据为空，直接加载所有楼房数据
            //将点击搜索条件cookie全部清空
            cookie('ss',null);
            cookie('px',null);
            cookie('qy',null);
            cookie('min_price',null);
            cookie('max_price',null);
            cookie('lx',null);
            cookie('hx',null);


            //区域搜索显示
            $city_id = cookie('city_id');
            $region = M('region');
            //检索所有所在城市下的区
            $districe = $region->where("parent_id = $city_id")->field('region_name')->select();



            //所搜索的楼盘名称
            $likes = I('post.house_name','','trim');
            cookie('ss',$likes);
            if ($likes!='') {
                $where['hs.title']= array('like',"%$likes%");
                //显示楼盘数据
                $data = M()->table('tf_house as hs')->limit(5)->join('tf_house_type as hst on hs.id = hst.house_id','LEFT')->field('hs.*,hst.room,hst.hall,hst.toilet')->group('hst.house_id')->where($where)->select();


                //获取房屋户型、类型
                $house_mold = C('lp_type');
                $house_type = C('HOUSE_TYPE');
                unset($house_type['other']);                //去掉不限


                $this->assign('districe',$districe);        //县区数据
                $this->assign('loading','加载更多');        //查看更多
                $this->assign('data',$data);                //获取5条数据传到列表页
                $this->assign('house_mold',$house_mold);    //房屋类型
                $this->assign('house_type',$house_type);    //房屋户型
                $this->assign('page_title','楼盘列表');
                $this->display('index');
            } else {
                //如果搜索数据为空，直接加载所有楼房数据
                //将点击搜索条件cookie全部清空
                cookie('ss',null);
                cookie('px',null);
                cookie('qy',null);
                cookie('min_price',null);
                cookie('max_price',null);
                cookie('lx',null);
                cookie('hx',null);


                //区域搜索显示
                $city_id = cookie('city_id');
                $region = M('region');
                //检索所有所在城市下的区
                $districe = $region->where("parent_id = $city_id")->field('region_name')->select();


                //显示楼盘数据
                $data = M()->table('tf_house as hs')->limit(5)->join('tf_house_type as hst on hs.id = hst.house_id','LEFT')->field('hs.*,hst.room,hst.hall,hst.toilet')->group('hst.house_id')->select();

                //获取房屋户型、类型
                $house_mold = C('lp_type');
                $house_type = C('HOUSE_TYPE');
                unset($house_type['other']);                //去掉不限


                $this->assign('districe',$districe);        //县区数据
                $this->assign('loading','加载更多');        //查看更多
                $this->assign('data',$data);                //获取5条数据传到列表页
                $this->assign('house_mold',$house_mold);    //房屋类型
                $this->assign('house_type',$house_type);    //房屋户型
                $this->assign('page_title','楼盘列表');
                $this->display('index');
            }
        }
    }




    //所有搜索和加载更多调用数据
    public function house_super_select(){
        if(!IS_POST){
            $this->error('页面不存在',U('index/index'));
        }

        //保存where的数组
        $order = null;
        $selects = null;
        //1.异步获取搜索类型和搜索条件
        $type = I('post.types','','trim');
        $condition = I('post.condition','','trim');


        //当结束条数为空时，加载5条
        $endnum = isset($endnum) ? $endnum : 5;
        //2.判断类型将搜索的数据存入cookie
        if ($type=='jz') {
            $endnum = $condition;
        } elseif ($type=='ss') {
            //判断搜索框的输入
            if ($condition=='') {
                cookie('ss',null);
            } else {
                cookie('ss',$condition);
            }
        } elseif ($type=='px') {
            //判断排序
            if ($condition!='') {
                cookie('px',$condition);
            }
        } elseif ($type=='qy') {
            //判断房屋所在地区
            if ($condition=="不限") {
                cookie('qy',null);
            } else {
                cookie('qy',$condition);
            }
        } elseif ($type=="hx") {
            //判断户型
            if ($condition=="不限") {
                cookie('hx',null);
            } elseif ($condition=="one") {
                cookie('hx',1);
            } elseif ($condition=="two") {
                cookie('hx',2);
            } elseif ($condition=="three") {
                cookie('hx',3);
            } elseif ($condition=="four") {
                cookie('hx',4);
            } elseif ($condition=="five") {
                cookie('hx',5);
            } elseif ($condition=="six") {
                cookie('hx',6);
            }
        } elseif ($type=="jg") {
            //判断是价格范围
            if($condition=="不限"){
                cookie('min_price',null);
                cookie('max_price',null);
            } elseif ($condition=="3000-") {
                cookie('min_price',1);
                cookie('max_price',3000);
            } elseif ($condition=="3000-4000") {
                cookie('min_price',3000);
                cookie('max_price',4000);
            } elseif ($condition=="4000-5000") {
                cookie('min_price',4000);
                cookie('max_price',5000);
            } elseif ($condition=="5000-6000") {
                cookie('min_price',5000);
                cookie('max_price',6000);
            } elseif ($condition=="6000+") {
                cookie('min_price',6000);
                cookie('max_price',999999999999999999999999999999999999999999999);
            }
        } elseif ($type=="lx") {
            //判断房子什么类型
            if ($condition=="不限") {
                cookie('lx',null);
            } else {
                cookie('lx',$condition);
            }
        }

        //3.判断后分别写出各自的where条件

        //所搜索的楼盘
        if (cookie('ss')!=null) {
            $selects['hs.title'] = array('like',"%".cookie('ss')."%");
        }

        //排的顺序
        if (cookie('px')!=null) {
            $order = cookie('px');
            $order = array("hs.price $order");
        }

        //判断区域
        if(cookie('qy')!=null) {
            $selects['hs.district_id'] = array('eq',cookie('qy'));
        }

        //判断钱数
        if (cookie('min_price')!=null&&cookie('max_price')!=null) {
            $selects['hs.price'] = array('between',array(cookie('min_price'),cookie('max_price')));
        }

        //判断房屋类型
        if (cookie('lx')!=null) {
            $selects['hs.jzlx'] = array('eq',cookie('lx'));
        }

        //判断房屋户型
        if (cookie('hx')!=null) {
            $selects['hst.room'] = array('eq',cookie('hx'));
        }

        //执行sql语句
        $data = M()->table('tf_house as hs')->field('hs.*,hst.room,hst.hall,hst.toilet')->where($selects)->order($order)->join('tf_house_type as hst on hs.id = hst.house_id','LEFT')->limit(0,$endnum)->group('hst.house_id')->select();

        $this->ajaxReturn($data);
    }

    
}
    