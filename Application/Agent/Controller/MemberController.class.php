<?php
namespace Agent\Controller;

use Agent\Controller\BaseController;

/**
 * 我的会员控制器
 * Created by PhpStorm.
 * @User: LT
 * @Date: 2016/11/9
 * @Time: 23:37
 */
class MemberController extends BaseController
{
    /**
     * 我的会员
     */
    public function index()
    {
        $user = $this->getUser();
        $user_id = $user['id'];
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
        } else {
            //数据分页
            $admin = M('user');
            $count = $admin->where(array('parentid' => $user_id))->count();
            $page_size = C("PAGE_SIZE");
            $Page = new \Think\Page($count, $page_size);
            $list = $admin->where(array('parentid' => $user_id))->order("add_time desc")->limit($Page->firstRow . ',' . $Page->listRows)->select();/*getlastsql*/
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $show = $Page->show();
            $this->assign('list', $list);
            $this->assign('fenye', $show);
            $this->assign("page_title", "我的会员");
            $this->display();
        }
    }

    /*
 *搜索功能
 */
    public function select()
    {
        $db = M('user');
        $user = $this->getUser();
        $user_id = $user['id'];
        $val = $_POST['find'];
        $val = trim($val);
        if (!empty($val)) {
            session('member_search_key', $val);
        }
        $val = empty($val) ? session('member_search_key') : $val;
        $where['name'] = array('like', "%$val%");
        $where['parentid'] = $user_id;
        $count = $db->where($where)->count();
        if ($count == 0) {
            $this->assign('sel_exist', '搜索内容不存在');
            $this->assign("page_title", "我的会员");
            $this->display(index);
            exit;
        } else {
            $page_size = C("PAGE_SIZE");
            $Page = new \Think\Page($count, $page_size);
            $list = "SELECT * FROM  tf_user WHERE name LIKE '%$val%' AND parentid = $user_id order by add_time desc  LIMIT $Page->firstRow  ,$Page->listRows ";
            $date = M()->query($list);
            $Page->setConfig('prev', '上一页');
            $Page->setConfig('next', '下一页');
            $show = $Page->show();
            $this->assign('list', $date);
            $this->assign('fenye', $show);
            $this->assign("page_title", "我的会员");
            $this->display(index);
        }
    }

    /*
     * 删除操作
     */
    public function del()
    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        if (empty($id)) {
            $this->error("非法操作");
        } else {
            $my_id = $this->getMyId();
            if (!$this->is_children($id, $my_id)) {
                $this->error("非法操作");
            } else {
                $db = M('user');
                $rs = $db->where("id=$id")->delete();
                if ($rs) {
                    $goto = U("agent/member/index");
                    $this->success("添加成功", $goto);
                } else {
                    $this->error("删除失败");
                }
            }
        }
    }

    /**
     * 添加会员
     */
    public function add()
    {
        if (IS_POST) {
            $user = $this->getUser();
            $user_id = $user['id'];
            $name = $_POST['name'];
            $pwd = $_POST['pwd'];
            $real_name = $_POST['real_name'];
            $tel = $_POST['tel'];
            $identity = $_POST['identity'];
            $age = $_POST['age'];
            $sex = $_POST['sex'];
            $province_id = $_POST['province_id'];
            $city_id = $_POST['city_id'];
            $district_id = $_POST['district_id'];
            $address = $_POST['address'];
            $remark = $_POST['remark'];
            $level_id = $_POST['level_id'];
            $db = M("user");
            //检验用户名是否已经存在
            $test_name = $db->where(array('name' => $name))->find();
            if (empty($test_name)) {
                //检验电话号码是否已经存在
                $test_tel = $db->where(array('tel' => $tel))->find();
                if (empty($test_tel)) {
                    //检验身份证号码是否已经存在
                    $test_identity = $db->where(array('identity' => $identity))->find();
                    if (empty($test_identity)) {
                        $options = M('options');
                        $data = $options->select();
                        $new_array = array();
                        foreach ($data as $key => $val) {
                            $new_array[$val['key']] = $val['value'];
                        }
                        $month_fans_max =$new_array['month_fans_max'] ;
                        $guid = $this->create_guid();;
                        $data = array(
                            'name' => $name,
                            'pwd' => md5($pwd),
                            'real_name' => $real_name,
                            'tel' => $tel,
                            'identity' => $identity,
                            'age' => $age,
                            'sex' => $sex,
                            'province_id' => $province_id,
                            'city_id' => $city_id,
                            'district_id' => $district_id,
                            'address' => $address,
                            'parentid' => $user_id,
                            'remark' => $remark,
                            'add_time' => date("Y-m-d H:i:s", time()),
                            'user_type' => 'member',
                            'is_validated' => 'pending',
                            'month_fans' => $month_fans_max,
                            'fans_end_time' => date("Y-m-d H:i:s", time()+3600*24*730),
                            'level_id' => $level_id,
                            'guid' => $guid
                        );
                        $rs = $db->data($data)->add();
                        if ($rs) {
                            $goto = U("agent/member/index");
                            $this->success("添加成功", $goto);
                        } else {
                            $error = $db->getError();
                            $this->error("添加失败:$error");
                        }
                    } else {
                        $this->error("该身份证已被注册");
                        exit;
                    }
                } else {
                    $this->error("该电话已被注册");
                    exit;
                }
            } else {
                $this->error("该用户名已被注册");
                exit;
            }

        } else {
            $my_id = $this->getMyId();
            $my_data = M("user")->where("id=$my_id")->find();
            $this->assign("my_data", $my_data);
            $level = M('level');
            $member_level = $level->select();
            $this->assign('member_level', $member_level);
            $this->assign("page_title", "添加会员");
            $this->display();
        }
    }

    /**
     * 修改会员
     */
    public function edit()
    {
        if (IS_POST) {
            $id = $_POST['id'];
            $pwd = $_POST['pwd'];
            $real_name = $_POST['real_name'];
            $tel = $_POST['tel'];
            $age = $_POST['age'];
            $province_id = $_POST['province_id'];
            $city_id = $_POST['city_id'];
            $district_id = $_POST['district_id'];
            $address = $_POST['address'];
            $remark = $_POST['remark'];
            $level_id = $_POST['level_id'];
            //判断修改id是否存在
            if (empty($id)) {
                $this->error("对不起，没有该修改项");
            } else {
                //判断当前会员是不是属于自己的下线
                $my_id = $this->getMyId();
                if (!$this->is_children($id, $my_id)) {
                    $this->error("非法操作");
                }
                $db = M('user');
                //检验电话号码是否已经存在
                $condition_tel['tel'] = $tel;
                $condition_tel['id'] = array('neq', $id);
                $test_tel = $db->where($condition_tel)->find();
                if (empty($test_tel)) {
                    $data = array(
                        'id' => $id,
                        'pwd' => md5($pwd),
                        'real_name' => $real_name,
                        'tel' => $tel,
                        'age' => $age,
                        'province_id' => $province_id,
                        'city_id' => $city_id,
                        'district_id' => $district_id,
                        'address' => $address,
                        'remark' => $remark,
                        'level_id' => $level_id
                    );
                    //更新数据
                    $rs = $db->where("id=$id")->save($data);
                    if ($rs===false) {
                        $error = $db->getError();
                        $this->error("修改失败:$error");
                    } else {
                        $goto = U("agent/member/index");
                        $this->success("修改成功", $goto);
                    }
                } else {
                    $this->error("该电话已被注册");
                    exit;
                }
            }

        } else {
            //判断修改id是否为空
            $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
            if (empty($id)) {
                $this->error("对不起，没有该修改项");
            } else {
                $obj = M("user");
                //判断当前会员是不是属于自己的下线
                $my_id = $this->getMyId();
                if (!$this->is_children($id, $my_id)) {
                    $this->error("非法操作");
                }
                $data = $obj->where("id=$id")->find();
                $this->assign("data", $data);
                $level = M('level');
                $member_level = $level->select();
                $this->assign('member_level', $member_level);
                $this->assign("page_title", "修改会员");
                $this->display();
            }
        }
    }

    /**
     * 获取我的ID
     * @return mixed
     */
    private function getMyId()
    {
        $my_data = $this->getUser();
        $my_id = $my_data['id'];
        return $my_id;
    }



    /**
     * 判断某用户是否是属于我的下线
     * @param $child_id
     * @param $parent_id
     * @return bool
     */
    public function is_children($child_id, $parent_id)
    {
        $obj = M("user");
        //判断当前会员是不是属于自己的下线
        $my_data = $this->getUser();
        $my_id = $my_data['id'];
        $has = $obj->where(array('id' => $child_id, 'parentid' => $parent_id))->find();
        if (empty($has)) {
            return false;
        }
        return true;
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        session("member_search_key", "");
    }

    /**
     * 生成唯一ID
     *
     * @param int $length
     * @return string
     */
    function create_guid($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	//+-*#&@!?
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}