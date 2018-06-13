<?php
namespace Home\Controller;
use Home\Controller\BaseController;
header('content-type:text/html;charset=utf8;');
/**
 * 新车控制器
 * Class CarController
 * @package Home\Controller
 * @author 1525099****@qq.com  dy
 * @date 2016-11-21
 */
class CarController extends BaseController{
    //车辆列表
    public function index(){
        //清理cookie
        cookie('ss',null);
        cookie('px',null);
        cookie('pp',null);
        cookie('jb',null);
        cookie('max_price',null);
        cookie('qd',null);
        cookie('jg',null);
        cookie('bsx',null);

        //汽车列表首页
        $car = M('car');
        //筛选汽车数据
        $cardata = $car->limit(5)->select();

        //获取搜索栏目数据
        $car_brand = C('CAR_BRAND');                            //汽车品牌
        $car_size = C('CAR_SIZE');                              //汽车级别
        $car_drive = C('CAR_DRIVE');                            //驱动
        $car_structure = C('CAR_STRUCTURE');                    //车身结构
        $car_gear_box = C('CAR_GEAR_BOX');                      //变速箱


        //向前台抛数据
        $this->assign('cardata',$cardata);                      //汽车数据
        $this->assign('carbrand',$car_brand);                   //汽车品牌
        $this->assign('carsize',$car_size);                     //汽车级别
        $this->assign('cardrive',$car_drive);                   //汽车驱动
        $this->assign('carstructure',$car_structure);           //汽车车身结构
        $this->assign('cargearbox',$car_gear_box);              //汽车变速箱
        $this->assign('page_title','新车首页');
        $this->display();
    }

    //车辆详情
    public function car_details(){
        $id = $_GET['id'];
        $mysql = M('car');
        $sql = "select * from tf_car where id = $id";
        $rs = $mysql->query($sql);
        $this->assign('data',$rs[0]);
        $sql1 = "select * from tf_car where is_recommended = '1' limit 0,4";
        $rs1 = $mysql->query($sql1);
        $this->assign('recommended',$rs1);
        $this->assign('page_title','新车详情');
        $this->display();
    }
    //提交表单
    function form(){
        $mysql = M('car');
        $title = $_POST['title'];
        $car_style = $_POST['car_style'];
        $car_my_type = $_POST['car_my_type'];
        $car_my_price = $_POST['car_my_price'];
        $name = $_POST['name'];
        $tel = $_POST['tel'];
        $beizhu = $_POST['beizhu'];
        $car_id = $_POST['car_id'];
        $sql = "select * from tf_car where id = $car_id";
        $data = $mysql->query($sql);
        $car_brand = $data[0]['brand'];
        $car_market_price = $data[0]['price_max'];
        $car_company_name = $data[0]['company'];
        $car_company_addr = $data[0]['address'];
        $add_time = date("Y-m-d H-i-s",time());

        /*$sql1 = "insert into tf_orders vlaue(sn=null,user_id=null,
product_id=null,product_name=$title,name=$name,tel=$tel,
status='pending',sex=null,age=null,add_time=$add_time,order_type='auto',
car_brand=$car_brand,car_level=null,like_car=$car_my_type,
car_market_price=$car_market_price,car_my_price=$car_my_price,
car_company_name=$car_company_name,car_company_addr=$car_company_addr)";
        */
        // clf:
        $data['sn'] = null;
        $data['user_id'] = null;
        $data['product_id'] = null;
        $data['product_name'] = $title;
        $data['name'] = $name;
        $data['tel'] = $tel;
        $data['status'] = 'pending';
        $data['sex'] = null;
        $data['age'] = null;
        $data['add_time'] = $add_time;
        $data['order_type'] = 'auto';
        $data['car_brand'] = $car_brand;
        $data['car_level'] = null;
        $data['like_car'] = $car_my_type;
        $data['car_market_price'] = $car_market_price;
        $data['car_my_price'] = $car_my_price;
        $data['car_company_name'] = $car_company_name;
        $data['car_company_addr'] = $car_company_addr;

        $rs = M('orders')->add($data);
        //$rs = $mysql->execute($sql1);
        if ($rs){
            $this->success('添加订单成功');
        }else{
            $this->error('添加订单失败');
        }

    }

    //车辆详情
    public function car_photo(){
        $id = $_GET['id'];
        $mysql = M('car');
        $sql = "select title,thumb,images from tf_car where id = $id";
        $rs  = $mysql->query($sql);
        $this->assign('data',$rs[0]);
        $images = unserialize($rs[0]['images']);
        $this->assign('images',$images);
        $this->assign('page_title','新车图示');
        $this->display();
    }


    //异步搜索
    public function car_select(){
        if(!IS_POST){
            $this->error('页面发生错误',U('index/index'));
        }
        //用来存储搜索条件
        $select = null;
        //接收搜索参数
        $car_type = I('post.types','','trim');
        $car_condition = I('post.condition','','trim');

        //当结束条数为空时，加载5条
        $endnum = isset($endnum) ? $endnum : 5;


        if ($car_type=='jz') {
            //记录结束数据条数
            $endnum = $car_condition;
        } elseif ($car_type=='px') {
            cookie('px',$car_condition);
        } elseif ($car_type=='ss') {
            //搜索框
            if ($car_condition=='') {
                cookie('ss',null);
            } else {
                cookie('ss',$car_condition);
            }
        } elseif ($car_type=='pp') {
            //品牌搜索条件
            if($car_condition=='不限'){
                cookie('pp',null);
            }else{
                cookie('pp',$car_condition);
            }
        } elseif ($car_type=='jb') {
            //级别搜索条件
            if($car_condition=='不限'){
                cookie('jb',null);
            }else{
                cookie('jb',$car_condition);
            }
        } elseif ($car_type=='qd') {
            //驱动搜索条件
            if($car_condition=='不限'){
                cookie('qd',null);
            }else{
                cookie('qd',$car_condition);
            }
        } elseif ($car_type=='jg') {
            //结构搜索条件
            if($car_condition=='不限'){
                cookie('jg',null);
            }else{
                cookie('jg',$car_condition);
            }
        } elseif ($car_type=='bsx') {
            //变速箱搜索条件
            if($car_condition=='不限'){
                cookie('bsx',null);
            }else{
                cookie('bsx',$car_condition);
            }
        }


        //把搜索条件写入where中
        //搜索框
        if(cookie('ss')!=''){
            $select['title'] = array('like',"%".cookie('ss')."%");
        }
        //价格排序
        if(cookie('px')!=''){
            $orders = cookie('px');
            $orders = array("price_min $orders");
        }
        //搜索品牌条件
        if(cookie('pp')!=''){
            $select['brand'] = array('eq',cookie('pp'));
        }
        //搜索级别条件
        if(cookie('jb')!=''){
            $select['size'] = array('eq',cookie('jb'));
        }
        //搜索驱动条件
        if(cookie('qd')!=''){
            $select['drive'] = array('eq',cookie('qd'));
        }
        //搜索结构条件
        if(cookie('jg')!=''){
            $select['structure'] = array('eq',cookie('jg'));
        }
        //搜索变速箱条件
        if(cookie('bsx')!=''){
            $select['gearbox'] = array('eq',cookie('bsx'));
        }

        //写出遍历数据sql
        $data = M('car')->where($select)->limit(0,$endnum)->order($orders)->select();
        $this->ajaxReturn($data);

    }
}