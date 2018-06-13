<?php

/**
 * 楼盘管理控制器
 * Class HouseController
 * @package Admin\Controller
 * @user ZJN
 * @date 2016-11-15
 */
namespace Agent\Controller;
use Agent\Controller\BaseController;
use Boris\DumpInspector;
use Common\Util;
use MyProject\First\MyClass;

class HouseController extends BaseController
{
    /**
     * 楼盘列表
     */
    public function index(){
        $user = $this->getUser();
        $user_id = $user['id'];
        $db = M("house");
        $count =$db->where("add_user_id=$user_id")->count();
        $page_size = C("PAGE_SIZE");
        $page =new Util\MyPage($count,$page_size);
        $data = $db->where("add_user_id = $user_id")->limit($page->firstRow.','.$page->listRows)->select();
        $page=$page->show();
        $this->assign("row",$data);
        $this->assign("page",$page);
        //页面标题
        $this->assign('page_title','楼盘管理');
        //渲染模板
        $this->display();
    }

    /**
     * 楼盘数据删除(数据库操作)
     */
    public function house_del($del_id){

        $model = M("house");
        $data['id'] = array('in', $del_id);
        $rs = $model->where($data)->delete();
        //删除户型表中对应数据
        $data1['house_id'] = array('in', $del_id);
        M('house_type')->where($data1)->delete();

        $url = U("house/index");
        if ($rs !== false) {
            $this->success("数据删除成功", $url);
        } else {
            $this->error("数据删除失败", $url);
        }
    }

    /**
     * 楼盘数据修改
     */
     public function house_update(){


         $upda_id = I('get.update_id', '');
         $data = M('house')->where("id=$upda_id")->select();
         $this->assign('data', $data);
         //获取户型信息
         $hx_data = M('house_type')->where("house_id=$upda_id")->select();
         $this->assign('hx_data', $hx_data);
         //楼盘相册
         $img_arr = unserialize($data[0]['images']);
         $this->assign('img_arr', $img_arr);

         //建筑类型
         $lp_type = C('lp_type');
         $this->assign('lp_type', $lp_type);
         //物业类型
         $wy_type = C('wy_type');
         $this->assign('wy_type', $wy_type);
         $this->assign('page_title', '修改楼盘信息');
         $this->display();
         /* if(!IS_POST){
             $this->error('页面不存在',U('index'));
          }
          $id = I('post.id');
          $data[title] = I('post.title','','trim');
          $data[price] = I('post.price','','trim');
          $data[property_type] = I('post.property_type','','trim');
          $aa = $data[thumb] = I('post.files');

          $db = M("house");
          $rs = $db->where("id=$id")->data($data)->save();
          $url = U("house/index");
          if ($rs !== false) {
              $this->success("数据修改成功", $url);
          } else {
              $this->error("数据修改失败", $url);
                 }*/
     }

    /**
     * 楼盘数据库查找
     */
    public function search()
    {
        $db = M("house");
        $search_key =  I('post.search1','','trim');
            if ($search_key=='') {
               //$sql = "select * from house";
                $data = $db->select();
            } else {
                //$sql = "select * from house where title LIKE '%$search_key%'";
                $data['title'] = array('like',"%$search_key%");
                $data = $db->where($data)->select();
            }
        
        $rs = $this->assign("row",$data);
        $this->display(index);
    }

    /**
     * 添加楼盘
     */
    public function add(){
	$user = $this->getUser();
        $user_id = $user['id'];
        //添加楼盘 基本信息
        //楼盘名称
        $data['add_user_id'] = $user_id;
        $data['title'] = I('post.house_name');
        //楼盘简介
        $data['summary'] = I('post.house_megs');
        //物业类型
        $data['property_type'] = I('post.house_type');
        //建筑类型
       // $data[''] = I('post.jz_type');
        //参考价格
        $data['price'] = I('post.price');
        //项目特色
        $data['feature'] = I('post.feature');
        //区域(省)
        $data['province_id'] = I('post.province_id');
        //区域(市)
        $data['city_id'] = I('post.city_id');
        //区域(县，区)
        $data['district_id'] = I('post.district_id');
        //楼盘地址
        $data['address'] = I('post.house_address');
        //售楼地址
        $data['sale_address'] = I('post.sl_address');
        //开发商
        $data['builder_company'] = I('post.developer');
        //是否推荐
        $data['is_recommended'] = I('post.is_recommended');
        //是否热门
        $data['is_hot'] = I('post.is_hot');
        //状态
        $data['is_sale'] = I('post.is_sale');
        //楼盘缩略图
        $data['thumb'] = I('post.jb_image');
        //添加楼盘相册
        $arr_lp = I('post.lp_thumb');
        $lp_text = I('post.lp_text');
        $arr_lp_num = count($arr_lp);
        $arr_new = array();
        $sum = $arr_lp_num / 4;
        for ($i = 1; $i < $sum; $i++) {
            $arr_new [] = array('title' => $lp_text[$i],
                'images' => array($arr_lp[$i * 4], $arr_lp[$i * 4 + 1],
                    $arr_lp[$i * 4 + 2], $arr_lp[$i * 4 + 3]));
        }
        $str = serialize($arr_new);
        $data['images'] = $str;

        //其他信息
        //最新开盘
        $da = date('Y-m-d',time());
        $_time = I('post.zj','','trim');
        if(empty($_time)){
            $_time = $da;
        }
        $data['open_time'] = $_time;
        //获取产权年限
        $data['cqnx'] = I('post.cq');
        $db = M("house")->data($data)->add();

        //获取house_id 关联 表house_type
        $last_id=  M('house')->getLastInsID();

        //添加户型操作
        //户型名称
        $hx = I('post.hx');
        //户型朝向
        $hx_cx = I('post.hx_cx');
        //建筑面积
        $jz_mj = I('post.jz_mj');
        //居室
        $hx_type_s = I('post.hx_type_s');
        $hx_type_t = I('post.hx_type_t');
        $hx_type_w = I('post.hx_type_w');
        $thumb = I('post.thumb');
        $len = count($hx);
        $type = M('house_type');
        $re = true ;
        for ($i = 1 ;$i<$len ;$i++){
            $data['house_id'] = $last_id;
            $data['title'] = $hx[$i];
            $data['orientation'] = $hx_cx[$i];
            $data['area'] = $jz_mj[$i];
            $data['room'] = $hx_type_s[$i];
            $data['hall'] = $hx_type_t[$i];
            $data['toilet'] = $hx_type_w[$i];
            $data['thumb'] = $thumb[$i];
            $link = $type->add($data);
            if(!$link){
                $re = false;
            }
        }
        $url =  U('house/index');
        if(!$re){
            $this->error('数据添加失败!'.$type->getError(),$url);
        }else{
            $this->success('数据成功!',$url);
        }

    }

    public function house_add(){
        $this->assign('page_title', '添加楼盘');
        //编码
        header('Content-type:text/html;charset=utf-8');
        //建筑类型
        $lp_type = C('lp_type');
        $this->assign('lp_type', $lp_type);
        //物业类型
        $wy_type = C('wy_type');
        $this->assign('wy_type', $wy_type);
        $this->display();
    }

//楼盘数据修改
    public function data_update(){
        if(!IS_POST){
            $this->error('页面不存在',U('index/index'));
        }
        $id = I('post.up_id');
        $data['title'] = I('post.house_name');
        //楼盘简介
        $data['summary'] = I('post.house_megs');
        //物业类型
        $data['property_type'] = I('post.house_type');
        //建筑类型
        // $data[''] = I('post.jz_type');
        //参考价格
        $data['price'] = I('post.price');
        //项目特色
        $data['feature'] = I('post.feature');
        //区域(省)
        $data['province_id'] = I('post.province_id');
        //区域(市)
        $data['city_id'] = I('post.city_id');
        //区域(县，区)
        $data['district_id'] = I('post.district_id');
        //楼盘地址
        $data['address'] = I('post.house_address');
        //售楼地址
        $data['sale_address'] = I('post.sl_address');
        //开发商
        $data['builder_company'] = I('post.developer');
        //是否推荐
        $data['is_recommended'] = I('post.is_recommended');
        //是否热门
        $data['is_hot'] = I('post.is_hot');
        //状态
        $data['is_sale'] = I('post.is_sale');
        //楼盘缩略图
        $data['thumb'] = I('post.jb_image');
        //添加楼盘相册
        $arr_lp = I('post.lp_thumb');
        $lp_text = I('post.lp_text');
        $arr_lp_num = count($arr_lp);
        $arr_new = array();
        $sum = $arr_lp_num / 4;
        for ($i = 1; $i < $sum; $i++) {
            $arr_new [] = array('title' => $lp_text[$i],
                'images' => array($arr_lp[$i * 4], $arr_lp[$i * 4 + 1],
                    $arr_lp[$i * 4 + 2], $arr_lp[$i * 4 + 3]));
        }
        $str = serialize($arr_new);
        $data['images'] = $str;
        //其他信息
        //最新开盘
        $da = date('Y-m-d',time());
        $_time = I('post.zj','','trim');
        if(empty($_time)){
            $_time = $da;
        }
        $data['open_time'] = $_time;
        //获取产权年限
        $data['cqnx'] = I('post.cq');
        $db = M("house")->data($data)->where("id = $id")->save();
        //获取house_id 关联 表house_type
        $last_id=  M('house')->getLastInsID();

        //添加户型操作
        //户型名称
        $hx = I('post.hx');
        //户型朝向
        $hx_cx = I('post.hx_cx');
        //建筑面积
        $jz_mj = I('post.jz_mj');
        //居室
        $hx_type_s = I('post.hx_type_s');
        $hx_type_t = I('post.hx_type_t');
        $hx_type_w = I('post.hx_type_w');
        $thumb = I('post.thumb');
        $len = count($hx);
        $type = M('house_type');
        $re = true ;
        for ($i = 1 ;$i<$len ;$i++){
            $data['house_id'] = $last_id;
            $data['title'] = $hx[$i];
            $data['orientation'] = $hx_cx[$i];
            $data['area'] = $jz_mj[$i];
            $data['room'] = $hx_type_s[$i];
            $data['hall'] = $hx_type_t[$i];
            $data['toilet'] = $hx_type_w[$i];
            $data['thumb'] = $thumb[$i];
            $link = $type->save($data);
            if(!$link){
                $re = false;
            }
        }
        $url =  U('house/index');
        if(!$re and !$db){
            $this->error('数据修改失败!'.$type->getError(),$url);
        }else{
            $this->success('数据修改成功!',$url);
        }
    }
}


