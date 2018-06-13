<?php
namespace Agent\Controller;

use Agent\Controller\BaseController;
use Think\Page;
use Think\Model;
use Common\Util;

/**
 * 控制器基类
 * Created by PhpStorm.
 * User: ffy
 * Date: 2016/11/10
 * Time: 21:50
 * Description: 描述
 */
class FansController extends BaseController
{
    /**
     * 我的粉丝页面
     */
    public function index()
    {
        $user = $this->getUser();
        $id = $user['id'];
        //清空session
        session("keyword", null);
        //筛选数据
        $obj = M('user');
        $count = $obj->where(array('user_type' => 'fan'))->where("parentid=$id")->count();// 查询满足要求的总记录数
        $page_size = C("PAGE_SIZE");//调用每页显数量
        $Page = new Page($count, $page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $month_end = $obj->where(array('user_type' => 'fan'))->where("parentid=$id")->select('month_end');//日期
        $data = $obj->limit($Page->firstRow . ',' . $Page->listRows)->where(array('user_type' => 'fan'))->where("parentid=$id")->order('add_time DESC')->select();//数据集
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出
        $this->assign('data', $data);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        //页面标题
        $this->assign("page_title", "我的粉丝");
        $this->display("");
    }

    /**
     *  添加粉丝
     */
    public function add_fans()
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
            $identity = isset($_POST['identity']) ? $_POST['identity'] : null;
            $age = isset($_POST['age']) ? $_POST['age'] : null;
            $province_id = isset($_POST['province_id']) ? $_POST['province_id'] : null;
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : null;
            $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : null;
            $sex = isset($_POST['sex']) ? $_POST['sex'] : null;
            $address = isset($_POST['address']) ? $_POST['address'] : null;
            $remark = isset($_POST['remark']) ? $_POST['remark'] : null;
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
            $remark = trim($remark);
            $is_validated = 'no';
            $user_type = 'fan';
            $str=create_guid();
            if (empty($name)) {
                $this->error("无标题参数");
            }
            $user = $this->getUser();
            $id = $user['id'];

            $data = array(
                "guid" => $str,
                "is_validated" => $is_validated,
                "remark" => $remark,
                "parentid" => $id,
                "add_time" => date("Y-m-d H:i:s", time()),
                "fans_end_time" => date("Y-m-d H:i:s", strtotime("+2 year")),
                'pwd' => md5($pwd),
                'name' => $name,
                'tel' => $tel,
                'age' => $age,
                'sex' => $sex,
                'user_type' => $user_type,
                'province_id' => $province_id,
                'city_id' => $city_id,
                'district_id' => $district_id,
                'address' => $address,
                'identity' => $identity,
                'real_name' => $real_name,

            );

            $news = M("user");
//检验用户名是否已经存在
            $test_name = $news->where(array('name' => $name))->find();
            if (empty($test_name)) {
                //检验电话号码是否已经存在
                $test_tel = $news->where(array('tel' => $tel))->find();
                if (empty($test_tel)) {
                    //检验身份证号码是否已经存在
                    $test_identity = $news->where(array('identity' => $identity))->find();
                    if (empty($test_identity)) {
                        $month_fan = $news->where("id=$id")->find();//粉丝位
                        $month_fan= $month_fan['month_fans'] ;
                        if ($month_fan > 0) {
                            if ($result = $news->add($data)) {
                                $data = $news->where("id=$id")->find();
                                $num['month_fans'] = $data['month_fans'] - 1;
                                $news->where("id=$id")->save($num);//粉丝位
                            }
                        }else{
                            $this->error("您的粉丝位已用完");
                            exit;
                        }
                    }else{
                        $this->error("该身份证已被注册");
                        exit;
                    }
                }else{
                    $this->error("该电话已被注册");
                    exit;
                }
            }else{
                $this->error("该用户名已被注册");
                exit;
            }


            if (!$result) {
                $this->error("添加失败", U('Fans/add_fans'));
            } else {
                $this->success("添加成功", U('Fans/index'));
            }
        } else {
            $this->assign("page_title", "添加粉丝");
            $this->display();
        }
    }

    /**
     *  编辑粉丝
     */
    public function update()
    {
        //从数据库获取数据
        $id = $_GET['id'];
        if ($id) {
            $news = M("user");
            $data = $news->where("id=$id")->find();
            $this->assign('lists', $data);
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
            $remark = isset($_POST['remark']) ? $_POST['remark'] : null;
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
            $remark = trim($remark);
            if (empty($id)) {
                $this->error("无标题参数");
            }

            $data = array(
                "remark" => $remark,
                "add_time" => date("Y-m-d H:i:s", time()),
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
            );
            $news = M("user");



                //检验电话号码是否已经存在
                $test_tel = $news->where(array('tel' => $tel))->find();
                if (empty($test_tel)) {
                    //检验身份证号码是否已经存在
                    $test_identity = $news->where(array('identity' => $identity))->find();
                    if (empty($test_identity)) {
                        $result = $news->where("id=$id")->save($data);
                    }else{
                        $this->error("该身份证已被注册");
                        exit;
                    }
                }else{
                    $this->error("该电话已被注册");
                    exit;
                }


            if (!$result) {
                $this->error("修改失败", U('fans/update'));
            } else {
                $this->success("修改成功", U('fans/index'));
            }
        } else {
            $this->assign("page_title", "编辑粉丝");
            $this->display();
        }


    }

    /**
     * 删除
     */
    public function del()
    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        //删除数据
        $obj = M('user');
        $rs = $obj->where('id=' . $id . '')->delete();
        if ($rs) {
            $this->success("删除成功");
        } else {
            $this->error("删除失败");
        }

    }

    /**
     * 搜索
     */
    public function sel()
    {
        //调用每页显数量
        //获取搜索内容
        $keyword = $_GET['keyword'];
        $keyword = trim($keyword);
        if (!empty($keyword)) {
            session('keyword', $keyword);
        }
        $keyword = empty($keyword) ? session('keyword') : $keyword;
        //判断搜索内容是否存在
        if ($keyword) {
            $user = $this->getUser();
            $id = $user['id'];
            $page_size = C("PAGE_SIZE");//调用每页显数量
            $tf_user = M('user');
            $arr['name'] = array('like', "%$keyword%");
            $count = $tf_user->where(array('user_type' => 'fan'))->where($arr)->where("parentid=$id")->count();// 查询满足要求的总记录数
            $Page = new Page($count, $page_size);
            $data = $tf_user->limit($Page->firstRow . ',' . $Page->listRows)->where($arr)->where(array('user_type' => 'fan'))->where("parentid=$id")->select();//查询数据
            $this->assign("list", $data);
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $show = $Page->show();
            //页面标题
            $this->assign("page_title", "粉丝搜索");
            $this->assign("data", $data);
            $this->assign('page', $show);
            //渲染模板
            $this->display();
        } else {
            $this->error("非法操作：无参数");
        }
    }
}
