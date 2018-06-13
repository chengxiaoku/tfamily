<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Model;
use Think\Think;

/**
 * 控制器基类
 * Created by PhpStorm.
 * User: CJF
 * Date: 2016/11/21
 * Time: 21:50
 * Description: 描述
 */
class CarController extends BaseController{
    /**
     * 汽车管理页面
     */
    public function index(){
        session("car_search",null);
        //页面标题
        $this->assign("page_title","汽车管理");
        //筛选数据
        $obj = M('car');
        $p = trim(isset($_GET['p'])?$_GET['p']:1);
        $page_size = C("PAGE_SIZE");
        $data = $obj->order("add_time desc")->page($p,$page_size)->select();
        $count = $obj->count();//查询数据条数
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("data",$data);
        $this->assign("page",$show);
        //加载页面
        $this->display();
    }

    public function car_add(){
        //页面标题
        $this->assign("page_title","添加汽车");
        //获取汽车的配置参数
        $drive = C("CAR_DRIVE");//驱动
        $structure = C("CAR_STRUCTURE");//车身结构
        $gearbox = C("CAR_GEAR_BOX");//变速箱
        $brand = C("CAR_BRAND");//汽车品牌
        $size = C("CAR_SIZE");//汽车尺寸
        $this->assign("brand",$brand);
        $this->assign("size",$size);
        $this->assign("drive",$drive);
        $this->assign("structure",$structure);
        $this->assign("gearbox",$gearbox);
        //加载模板
        $this->display("car_add");
    }
    public function car_add_form(){
        $post_arr = I('post.');
        $car = M("car"); // 实例化User对象
        $data = array(
            'title' => I('post.title'),
            'price_min' => I('post.price_min'),
            'price_max' => I('post.price_max'),
            'company' => I('post.company'),
            'address' => I('post.address'),
            'emission' => I('post.emission'),
            'drive' => I('post.drive'),
            'gearbox' => I('post.gearbox'),
            'structure' => I('post.structure'),
            'province_id' => I('post.province_id'),
            'city_id' => I('post.city_id'),
            'district_id' => I('post.district_id'),
            'content' => I('post.content'),
            'add_time' => date('Y-m-d H-i-s',time()),
            'is_sale'=>I("post.is_sale"),
            'thumb'=>I("post.thumb"),
            'size'=>I("post.size"),
            'brand'=>I("post.brand"),
            'is_recommended'=>I("post.is_recommended")
        );
        foreach ($post_arr as $k=>$v) {
            foreach($data as $key=>$value){
                if($k==$key){
                    unset($post_arr[$key]);//删除$post_arr数组同值元素
                }
            }
        }
        $string_data = serialize($post_arr['imgs']);
        $data['images'] = $string_data;
        $result = $car->add($data);
        if ($result == '') {
            $this->error("添加失败",U('car/index'));
        } else {
            $this->success('添加成功',U('car/index'));
        }
    }

    public function car_edit() {
        $id = I('get.id');
        $car = M('car');
        $date = $car->where("id=$id")->select();
        $images = unserialize($date[0]['images']);
        $length  = 0;
        foreach ($images  as $key=>$val){
            $length = $key;
        }
        $this->assign('car',$date[0]);
        //$image = explode(',',$date[0]['images']);
        $this->assign("page_title","编辑汽车");
        //获取汽车的配置参数
        $drive = C("CAR_DRIVE");//驱动
        $structure = C("CAR_STRUCTURE");//车身结构
        $gearbox = C("CAR_GEAR_BOX");//变速箱
        $brand = C("CAR_BRAND");//汽车品牌
        $size = C("CAR_SIZE");//汽车尺寸
        $this->assign("length",$length);
        $this->assign("imgs",$images);
        $this->assign("drive",$drive);
        $this->assign("structure",$structure);
        $this->assign("gearbox",$gearbox);
        $this->assign("brand",$brand);
        $this->assign("size",$size);
        $this->display();
    }
    public function car_edit_form() {
        $post_arr = I('post.');
        $id = I('post.id');
        $car = M("car"); // 实例化User对象
        $data = array(
            'title' => I('post.title'),
            'price_min' => I('post.price_min'),
            'price_max' => I('post.price_max'),
            'company' => I('post.company'),
            'address' => I('post.address'),
            'emission' => I('post.emission'),
            'drive' => I('post.drive'),
            'gearbox' => I('post.gearbox'),
            'structure' => I('post.structure'),
            'province_id' => I('post.province_id'),
            'city_id' => I('post.city_id'),
            'district_id' => I('post.district_id'),
            'content' => I('post.content'),
            'add_time' => date('Y-m-d H-i-s',time()),
            'is_sale'=>I("post.is_sale"),
            'thumb'=>I("post.thumb"),
            'size'=>I("post.size"),
            'brand'=>I("post.brand"),
            'is_recommended'=>I("post.is_recommended")
        );
        foreach ($post_arr as $k=>$v) {
            foreach($data as $key=>$value){
                if($k==$key){
                    unset($post_arr[$key]);//删除$post_arr数组同值元素
                }
            }
        }
        unset($post_arr['id']);
        $string_data = serialize($post_arr['imgs']);
        $data['images'] = $string_data;
        $result = $car->where("id=$id")->save($data);
        if ($result == '') {
            $this->error("修改失败",U('car/index'));
        } else {
            $this->success('修改成功',U('car/index'));
        }
    }
    /**
     * 删除数据
     */
    public function del(){
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        if($id == ""){
            $this->error("缺少产数 ");
            die();
        }
        //删除数据
        $obj = M("car");
        $rs = $obj->where("id = $id")->delete();
        if($rs){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

    /**
     * 搜索
     */
    public function search(){
        $p = I("get.p","1",'trim');
        $page_size = C("PAGE_SIZE");
        $begin = ($p-1)*$page_size;
        //搜索的内容
        $search = I("post.search","",'trim');
        if(!empty($search)){
            session("car_search",$search);
        }
        $search = empty($search)?session("car_search"):$search;
        //搜索数据
        $obj = M("car");
        $sql = null;
        if(empty($search)){
            $page_sql = "select * from tf_car limit $begin,$page_size";
            $sql = "select * from tf_car";
        }else{
            $page_sql = "select * from tf_car WHERE title LIKE '%$search%' limit $begin,$page_size";
            $sql = "select * from tf_car WHERE title LIKE '%$search%'";
        }
        //分页
        $page_num = $obj->query($sql);
        $count = count($page_num);//查询总条数
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("page",$show);
        $data = $obj->query($page_sql);
        $this->assign("data", $data);
        //搜索内容返回
        $this->assign("search",$search);
        //页面标题
        $this->assign("page_title","汽车管理");
        //加载模板
        $this->display("index");
    }
}