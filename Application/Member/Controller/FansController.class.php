<?php
namespace Member\Controller;
use Member\Controller\BaseController;
use Think\Page;
/**
 * 我的粉丝
 * Created by PhpStorm.
 * User: ybf
 * Date: 2016/11/12
 * Time: 13:50
 */
class FansController extends BaseController
{

    //我的粉丝
    public function index()
    {
        $user = $this->getUser();
        $di = $user['id'];

        //筛选数据
        $obj = M('user');
        $num=C("PAGE_SIZE");
        $count = $obj->where(array('user_type'=>'fan'))->where("parentid=$di")->count();// 查询满足要求的总记录数
        $Page = new page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $limit=$Page->firstRow . ',' . $Page->listRows;
        $data = $obj->limit($limit)->where(array('user_type'=>'fan'))->where("parentid=$di")->order('add_time DESC')->select();//数据集
        $month_end = $obj->where(array('user_type' => 'fan'))->where("parentid=$di")->select('month_end');//结束日期

        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('data', $data);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出

        //页面标题
        $this->assign("page_title", "我的粉丝");
        $this->display("");
    }


//添加粉丝
    public function add()
    {

        //
        $category = M("user");
        $data = $category->select();
        $this->assign('lists', $data);
        //提交添加
        if (IS_POST) {
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
            $real_name = isset($_POST['real_name']) ? $_POST['real_name'] : null;
            $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
            $add_time = isset($_POST['add_time']) ? $_POST['add_time'] : null;
            $identity = isset($_POST['identity']) ? $_POST['identity'] : null;
            $age = isset($_POST['age']) ? $_POST['age'] : null;
            $status = isset($_POST['status']) ? $_POST['status'] : null;
            $province_id = isset($_POST['province_id']) ? $_POST['province_id'] : null;
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
            $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : null;
            $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            $pwd = trim($pwd);
            $real_name = trim($real_name);
            $tel = trim($tel);
            $identity = trim($identity);
            $age = trim($age);
            $province_id = trim($province_id);
            $city_id = trim($city_id);
            $district_id = trim($district_id);
            $sex = trim($sex);
            $address = trim($address);
            $user_type='fan';
            if (empty($name)) {
                $this->error("内容不能为空");
            }
            $user = $this->getUser();
            $di = $user['id'];

            $data = array(
                "parentid" => $di,
                'name' => $name,
                'pwd' => md5($pwd),
                'tel' => $tel,
                'age' => $age,
                'sex' => $sex,
                'province_id' => $province_id,
                'city_id' => $city_id,
                'district_id' => $district_id,
                'address' => $address,
                'identity' => $identity,
                'real_name' => $real_name,
                'user_type'=> $user_type,
                'add_time'=>date("Y-m-d H:i:s",time()),
                "fans_end_time" => date("Y-m-d H:i:s", strtotime("+2 year"))
            );

            $news = M("user");
            $month_fan= $news->where("id=$di")->select('month_fans');//获取粉丝位
            if($month_fan>0){
                if($result = $news->add($data)){
                    $data = $news->where("id=$di")->find();
                    $num['month_fans'] = $data['month_fans']-1;
                    $news->where("id=$di")->save($num);//粉丝位
                }
            }



            if (!$result) {
                $this->error("添加失败", U('Fans/add'));
            } else {
                $this->success("添加成功", U('Fans/index'));
            }
        } else {
            $this->assign("page_title", "添加粉丝");
            $this->display();
        }
    }


//编辑粉丝
    public function update()
    {


        //从数据库获取数据
        $id = $_GET['id'];
        if ($id) {
            $news = M("user");
            $data = $news->where("id=$id")->find();
            $this->assign('lists', $data);
        }
        //获取栏目名
        $category_id = $data['catid'];
        if ($category_id) {
            $category = M("category");
            $arr = $category->where("id=$category_id")->find();
            $this->assign('arr', $arr);
        }
        //提交修改
        if (IS_POST) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $pwd = isset($_POST['pwd']) ? $_POST['pwd'] : null;
            $real_name = isset($_POST['real_name']) ? $_POST['real_name'] : null;
            $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
            $identity = isset($_POST['identity']) ? $_POST['identity'] : null;
            $age = isset($_POST['age']) ? $_POST['age'] : null;
            $province_id = isset($_POST['province_id']) ? $_POST['province_id'] : null;
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
            $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : null;
            $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;

            if (empty($id)) {
                $this->error("操作无效");
            }
            $data = array(
                'pwd' => md5($pwd),
                'tel' => $tel,
                'age' => $age,
                'sex' => $sex,
                'add_time' =>date("Y-m-d H:i:s",time()),
                'province_id' => $province_id,
                'city_id' => $city_id,
                'district_id' => $district_id,
                'address' => $address,
                'identity' => $identity,
                'real_name' => $real_name
            );
            $news = M("user");
            $result = $news->where("id=$id")->save($data);
            if (!$result) {
                $this->error("修改失败", U('Fans/update'));
            } else {
                $this->success("修改成功", U('Fans/index'));
            }
        } else {
            $this->assign("page_title", "编辑粉丝");
            $this->display();
        }


    }

//删除操作
    public function del()

    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        //删除数据
        $obj = M('user');
        $rs = $obj->where('id=' . $id . '')->delete();
        if ($rs) {
            $this->success("删除成功",U('Fans/index'));
        } else {
            $this->error("删除失败",U('Fans/del'));
        }

    }


// 审核操作
    public function review()
    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        $review = trim(isset($_GET['review']) ? $_GET['review'] : "");
        //修改数据
        $obj = M('user');
        $obj->is_validated = $review;
        $obj->where('id=' . $id . '')->save();
        //返回首页
        $this->index();
    }


//搜索操作
    public function sel(){
        //获取搜索内容
        $keyword = $_GET['keyword'];
        $keyword = trim($keyword);
        //判断搜索内容是否存在
        if ($keyword) {
            $user = $this->getUser();
            $di = $user['id'];

            $tf_user = M('user');
            $num=C("PAGE_SIZE");
            $arr['name'] = array('like',"%$keyword%");
            $count = $tf_user->where(array('user_type'=>'fan'))->where("parentid=$di")->where($arr)->count();// 查询满足要求的总记录数
            $Page = new page($count,$num);// 实例化分页类 传入总记录数和每页显示的记录数(5)
            $limit=$Page->firstRow . ',' . $Page->listRows;
            $data = $tf_user->limit($limit)->where(array('user_type'=>'fan'))->where("parentid=$di")->where($arr)->order('add_time DESC')->select();//数据集
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $show = $Page->show();// 分页显示输出
            $this->assign('data', $data);// 赋值数据集
            $this->assign('page', $show);// 赋值分页输出
          
            $this->assign("list",$data);
            //页面标题
            $this->assign("page_title", "粉丝搜索");
            //渲染模板
            $this->display();
        }else{
            $this->error("非法操作：无参数");
        }
    }
}