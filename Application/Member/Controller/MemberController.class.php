<?php
namespace Member\Controller;
use Member\Controller\BaseController;

/**
 * 控制面板控制器
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 21:50
 */
class MemberController extends BaseController
{

    public function index()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
            //执行搜索函数select
            $val = $_POST['find'];
            $val = trim($val);
            if ($val == "") {
                $this->index();
            } else {
                $this->select($val);
            }
        } else {
            //数据分页
            $am = M('user');
            $user = $this->getUser();
            $user_id = $user['id'];
            $count = $am->where(array('parentid' => $user_id))->count();
            $page_size = C("PAGE_SIZE");
            $Page = new \Think\Page($count, $page_size);
            $sql = "SELECT * FROM  tf_user WHERE parentid = $user_id ORDER BY add_time DESC limit $Page->firstRow, $Page->listRows ";
            $data = $am->query($sql);
            //上一页
            $Page->setConfig('prev', '上一页');
            //下一页
            $Page->setConfig('next', '下一页');
            //分页效果
            $show = $Page->show();
            $this->assign('list', $data);
            $this->assign('page', $show);
            $this->assign("page_title", "我的会员");
            $this->display();
        }

    }

    /*
    *搜索功能
    */
    public function select($val)
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
            $sql = "SELECT * FROM  tf_user WHERE name LIKE '%$val%' AND parentid = $user_id OR tel LIKE '%$val%' LIMIT $Page->firstRow  ,$Page->listRows ";
            $date = M()->query($sql);
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
     * 删除数据
     */
    public function del()
    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        if (empty($id)) {
            $this->error("对不起，没有该删除项");
        } else {
            $db = M('user');
            $rs = $db->where("id=$id")->delete();
            if ($rs) {
                $this->success("删除成功");
            } else {
                $this->error("删除失败");
            }
        }

    }

    /*
     * 添加数据
     */
    public function add()
    {
        if (IS_POST) {
            //处理表单
            $user_name = isset($_POST['name']) ? $_POST['name'] : "";
            $user_pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
            $id_name = isset($_POST['id_name']) ? $_POST['id_name'] : "";
            $user_tel = isset($_POST['tel']) ? $_POST['tel'] : "";
            $user_id = isset($_POST['id']) ? $_POST['id'] : "";
            $user_age = isset($_POST['age']) ? $_POST['age'] : "";
            $user_sex = isset($_POST['sex']) ? $_POST['sex'] : "";
            $remark = $_POST['remark'];
            $level_id = $_POST['level_id'];
            $province_id = $_POST['province_id'];
            $city_id = $_POST['city_id'];
            $district_id = $_POST['district_id'];
            $home = isset($_POST['address_home']) ? $_POST['address_home'] : "";
            $user_name = trim($user_name);
            $user_id = trim($user_id);
            $home = trim($home);
            $user_tel = intval($user_tel);
            if (empty($user_name)) {
                $this->error("用户名不能为空");
                exit;
            } elseif (empty($user_pwd)) {
                $this->error("密码不能为空");
                exit;
            } elseif (empty($user_id)) {
                $this->error("身份证不能为空");
                exit;
            } elseif (empty($id_name)) {
                $this->error("真实姓名不能为空");
                exit;
            }

            //入库
            $db = M("user");
            //检验用户名是否已经存在
            $test_name = $db->where(array('name' => $user_name))->find();
            if (empty($test_name)) {
                //检验电话号码是否已经存在
                $test_tel = $db->where(array('tel' => $user_tel))->find();
                if (empty($test_tel)) {
                    //检验身份证号码是否已经存在
                    $test_identity = $db->where(array('identity' => $user_id))->find();
                    if (empty($test_identity)) {
                        $options = M('options');
                        $data = $options->select();
                        $new_array = array();
                        foreach ($data as $key => $val) {
                            $new_array[$val['key']] = $val['value'];
                        }
                        $month_fans_max =$new_array['month_fans_max'] ;
                        $parent_id = $this->getUser();
                        $m_id = $parent_id['id'];
                        $data = array(
                            'parentid' => $m_id,
                            'name' => $user_name,
                            'pwd' => md5($user_pwd),
                            'tel' => $user_tel,
                            'identity' => $user_id,
                            'real_name' => $id_name,
                            'address' => $home,
                            'add_time' => date("Y-m-d H-m-s", time()),
                            'month_end' => date("Y-m-d H-m-s",time()+3600*24*730),
                            'age' => $user_age,
                            'sex' => $user_sex,
                            'month_fans' => $month_fans_max,
                            'province_id' => $province_id,
                            'city_id' => $city_id,
                            'status' => 'disabled',
                            'user_type' => 'member',
                            'level_id' => $level_id,
                            'district_id' => $district_id,
                            'remark' => $remark,
                        );
                        $result = $db->data($data)->add();
                        $fans_m = $db->where("id = '.$m_id.'")->select();
                        if (count($fans_m['month_fans']) >= 5) {
                            echo '每月的粉丝数量不能超过4个！';
                            exit;
                        } else {
                            $sql = $db->getLastSql();
                            print_r($sql);
                            if ($result) {
                                $url = U("Member/member/index");
                                $this->success('添加成功了', $url);
                            } else {
                                $error = $db->getError();
                                $this->error("添加失败了", $error);
                                exit;
                            }
                        }}
                    else {
                            $this->assign('test_identity', '身份证已存在');
                            $this->assign("page_title", "添加会员");
                            $this->display();
                            exit;
                        }
                    } else {
                        $this->assign('test_tel', '电话已存在');
                        $this->assign("page_title", "添加会员");
                        $this->display();
                        exit;
                    }
                } else {
                    $this->assign('error', '用户名已存在');
                    $this->assign("page_title", "添加会员");
                    $this->display();
                    exit;
                }

            }
         else {
            //页面标题
            $this->assign("page_title", "添加会员");
            //加载分类
            $db1 = M("level");
            $my_id = $this->getMyId();
            $users = M("user")->where("id=$my_id")->find();
            $rs = $db1->select();
            $this->assign("data", $users);
             $this->assign('m_level', $rs);
            //渲染页面
             $this->display();
        }
    }


    public function edit()
    {
        if (IS_POST) {
            //处理表单
            $id = $_POST['id'];
            $user_name = isset($_POST['name']) ? $_POST['name'] : "";
            $user_pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";
            $user_pwd1 = isset($_POST['confirm_pwd']) ? $_POST['confirm_pwd'] : "";
            $id_name = isset($_POST['id_name']) ? $_POST['id_name'] : "";
            $user_tel = isset($_POST['tel']) ? $_POST['tel'] : "";
            $user_id = isset($_POST['id']) ? $_POST['id'] : "";
            $user_age = isset($_POST['age']) ? $_POST['age'] : "";
            $user_sex = isset($_POST['sex']) ? $_POST['sex'] : "";
            $province_id = $_POST['province_id'];
            $city_id = $_POST['city_id'];
            $level_id = $_POST['level_id'];
            $district_id = $_POST['district_id'];
            $address_home = isset($_POST['address_home']) ? $_POST['address_home'] : "";
            $user_remark = isset($_POST['remark']) ? $_POST['remark'] : "";
            $user_name = trim($user_name);
            $user_id = trim($user_id);
            $address_home = trim($address_home);
            $user_remark = trim($user_remark);
            $user_tel = intval($user_tel);
           if (empty($user_pwd)) {
                $this->error("密码不能为空");
                exit;
            } elseif (empty($user_id)) {
                $this->error("身份证不能为空");
                exit;
            } elseif (empty($id_name)) {
                $this->error("真实姓名不能为空");
                exit;
            } elseif ($user_pwd != $user_pwd1) {
                $this->error("密码不一致");
                exit;
            }
            //更新数据
            $db = M('user');
            //检验电话号码是否已经存在
            $condition_tel['tel'] = $user_tel;
            $condition_tel['id'] = array('neq', $id);
            $test_tel = $db->where($condition_tel)->find();
            if (empty($test_tel)) {
                $data = array(
                    'id' => $id,
                    'pwd' => md5($user_pwd),
                    'tel' => $user_tel,
                    'identity' => $user_id,
                    'real_name' => $id_name,
                    'address' => $address_home,
                    'age' => $user_age,
                    'sex' => $user_sex,
                    'province_id' => $province_id,
                    'district_id' => $district_id,
                    'remark' => $user_remark,
                    'city_id' => $city_id,
                    'level_id' => $level_id,
                );
                $rs = $db->where("id=$id")->save($data);;
                if ($rs) {
                    $goto = U("Member/member/index");
                    $this->success("修改成功", $goto);
                } else {
                    $error = $db->getError();
                    $this->error("修改失败:$error");

                }
            } else {
                $this->error("该电话已被注册");
                exit;
            }
        } else {
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
                $data = $obj->where("id=" . $id . "")->find();
                $this->assign("data", $data);
                $level = M('level');
                $m_level = $level->select();
                $this->assign('m_level', $m_level);
                $this->assign("page_title", "修改会员");
                $this->display();
            }
        }

    }
    /**
     * 获取ID
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

}