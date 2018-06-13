<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;
use Common\Util;

/**
 * 订单管理控制器
 * Class IndexController
 * @package Admin\Controller
 * @author CLF 710425820@qq.com
 * @date 2016-11-11
 */
class OrderController extends BaseController
{

    /**
     * 订单管理
     */
    public function orders()
    {

        //每 页数据数
        //$num =C('PAGE_SIZE');
        $num= 2;
        $this->assign('page_title', '订单管理');
        $User = M('orders');
        $count = $User->count();
        $Page = new Util\MyPage($count, $num);
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('add_time DESC')->limit($Page->firstRow . ',' . $Page->listRows)->select();

        // 赋值数据集
        $this->assign('data', $list);
        // 赋值分页输出
        $this->assign('page', $show);
        $data_arr = array();
        $i = 0;
        foreach ($list as $val){
            //省市区
            if(!empty($val['province'])){
                $data_s = M('region')->field("region_name")->where("region_id=".$val['province'])->select();
                $data_arr[$i][]=$data_s;
            }else{
                $data_arr[$i][] ='';
            }
            if(!empty($val['city'])){
                $data_ss = M('region')->field("region_name")->where("region_id=".$val['city'])->select();
                $data_arr[$i][]=$data_ss;
            }else{
                $data_arr[$i][] ='';
            }
            if(!empty($val['district'])){
                $data_q = M('region')->field("region_name")->where("region_id=".$val['district'])->select();
                $data_arr[$i][]=$data_q;
            }else{
                $data_arr[$i][] ='';
            }
            $i++;
        }

        $data_arr1= array();
        foreach ($data_arr as $value){
            foreach ($value as $val){
                if(is_array($val)){
                    $data_arr1[] = $val[0]['region_name'];
                    $i++;
                }else{
                    $data_arr1[] = $val;
                }
            }
        }

/*
        $data_arr1= array();
        foreach ($data_arr as $value){
            $i=0;
            if(is_array($value)){
                foreach ($value as $val){
                    $data_arr1[] =$val[0]['region_name'];
                    $i++;
                } 
            }
        }
*/

        $this->assign('data_city',$data_arr1);
        //获取 用户所属类型


        $user_arr =array();
        if(!empty($list)){
            foreach ($list as $val){
                $id = $val['user_id'];
                if(!empty($id)){
                    $user_arr[] =M('user')->field('user_type')->where("id=$id")->select();
                }
            }
        }
        $this->assign('user_arr',$user_arr);
        $this->display();
    }

    /**
     * 搜索分页
     */
    public function index_sel(){

        //每 页数据数
        $num =C('PAGE_SIZE');
        $this->assign('page_title', '订单管理');
        $User = M('orders');
        $find = I('post.find');
        if(!empty($find)){
            session('order_sec',$find);
        }
        $p = I('get.p','','trim');
        if(empty($p)){
            $p =1 ;
        }
        $start = ($p-1)*$num;
        $find = empty($find)?session('order_sec'):$find;
        $province = I('post.province_id','','trim');
        $city = I('post.city_id','','trim');
        $district = I('post.district_id','','trim');
        if(empty($province)){
            $sql = "select * from tf_orders where `name` LIKE '%$find%' OR `tel` LIKE '%$find%' ORDER BY `add_time` DESC LIMIT $start , $num";
            $sql_num = "select count(*) from tf_orders where `name` LIKE '%$find%' OR `tel` LIKE '%$find%'";
        }else if(empty($city)){
            $sql = "select * from tf_orders where `name` LIKE '%$find%' AND `province` = $province OR `tel` LIKE '%$find%'  AND `province` = $province ORDER BY `add_time` DESC LIMIT $start , $num";
            $sql_num = "select count(*) from tf_orders where `name` LIKE '%$find%' AND `province` = $province OR `tel` LIKE '%$find%'  AND `province` = $province";
        }else if(empty($district)){
            $sql = "select * from tf_orders where `name` LIKE '%$find%' AND `province` = $province AND `city` =$city OR `tel` LIKE '%$find%'  AND `province` = $province  AND `city` =$city ORDER BY `add_time` DESC LIMIT $start , $num";
            $sql_num = "select count(*) from tf_orders where `name` LIKE '%$find%' AND `province` = $province AND `city` =$city OR `tel` LIKE '%$find%'  AND `province` = $province  AND `city` =$city";
        }else{
            $sql = "select * from tf_orders where `name` LIKE '%$find%' AND `province` = $province AND `city` =$city AND `district` = $district OR `tel` LIKE '%$find%'  AND `province` = $province  AND `city` =$city AND `district` = $district ORDER BY `add_time` DESC LIMIT $start , $num";
            $sql_num = "select count(*) from tf_orders where `name` LIKE '%$find%' AND `province` = $province AND `city` =$city AND `district` = $district OR `tel` LIKE '%$find%'  AND `province` = $province  AND `city` =$city AND `district` = $district";
        }



        $num =$User->query($sql_num);
        //计算数据的数量
        $count = $num[0]['count(*)'];
        $Page = new Util\MyPage($count, C('PAGE_SIZE'));
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        //进行分页数据查询 注意limit方法的参数要使用Page类的属性

        $list = $User->query($sql);

        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        //$list = $User->select();
        // 赋值数据集
        $this->assign('data', $list);
        $this->assign('find',$find);
        // 赋值分页输出
        $this->assign('page', $show);
        $data_arr = array();
        $i = 0;

        foreach ($list as $val){
            //省市区
            if(!empty($val['province'])){
                $data_s = M('region')->field("region_name")->where("region_id=".$val['province'])->select();
                $data_arr[$i][]=$data_s;
            }else{
                $data_arr[$i][] ='';
            }
            if(!empty($val['city'])){
                $data_ss = M('region')->field("region_name")->where("region_id=".$val['city'])->select();
                $data_arr[$i][]=$data_ss;
            }else{
                $data_arr[$i][] ='';
            }
            if(!empty($val['district'])){
                $data_q = M('region')->field("region_name")->where("region_id=".$val['district'])->select();
                $data_arr[$i][]=$data_q;
            }else{
                $data_arr[$i][] ='';
            }
            $i++;
        }


        $data_arr1= array();
        foreach ($data_arr as $value){
            foreach ($value as $val){
                if(is_array($val)){
                    $data_arr1[] = $val[0]['region_name'];
                    $i++;
                }else{
                    $data_arr1[] = $val;
                }
            }
        }
        $this->assign('data_city',$data_arr1);
        //获取 用户所属类型

        $user_arr =array();
        foreach ($list as $val){
            $id = $val['user_id'];
            if(!empty($id)){
                $user_arr[] =M('user')->field('user_type')->where("id=$id")->select();
            }
        }

        $this->assign('user_arr',$user_arr);
        $this->display('orders');
    }

    /**
     * 订单详情
     */
    public function house_mess()
    {
        $this->assign('page_title', '订单详情');
        $id = I('get.id_mess');
        if(empty($id)){
            $this->error("缺少参数");
            die();
        }
        $data = M('orders')->where("id=$id")->select();
        $this->assign('data',$data);
        //获取意向楼盘
        
        //获取户型
        header('Content-type:text/html;charset=utf-8');
        //获取省市区
        //获取所在省
        if(!empty($data[0]['province'])){
            $adress_s = M('region')->field("region_name")->where("region_id=".$data[0]['province'])->select();
            $adress_s = $adress_s[0]['region_name'];
        }else{
            $adress_s = '';
        }
        
        if(!empty($data[0]['city'])){
            //获取所在市
            $adress_ss = M('region')->field("region_name")->where("region_id=".$data[0]['city'])->select();
            $adress_ss = $adress_ss[0]['region_name'];
        }else{
            $adress_ss = '';
        }

        if(!empty($data[0]['district'])){
            $adress_q = M('region')->field("region_name")->where("region_id=".$data[0]['district'])->select();
            $adress_q = $adress_q[0]['region_name'];
        }else{
            $adress_q = '';
        }
        //获取所在区
        $this->assign('adress_s',$adress_s);
        $this->assign('adress_ss',$adress_ss);
        $this->assign('adress_q',$adress_q);
        //获取客户类型
        $user_id = $data[0]['user_id'];
        if(!empty($user_id)){
            $us_data = M('user')->field('user_type')->where("id =$user_id")->select();
            $this->assign('user_typ',$us_data[0]['user_type']);
	    }
        $this->display();
    }

    /**
     * 审核
     */
    function sh(){
        $sh_id = I('post.sh_id','','trim');
        if(empty($sh_id)){
            echo 1;
        }
        $data['status'] = 'done';
        $link = M('orders')->where("id = $sh_id")->save($data);
        if($link){
            echo 2;
        }else{
            echo 1;
        }
    }

    /**
     * 测试，可以删除
     */
    /*public function showdata(){
        header('Content-type:text/html;charset=utf-8');
        $data = M('house')->select("1,4");
        dump($data);
    }*/
}