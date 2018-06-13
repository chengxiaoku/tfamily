<?php
namespace Agent\Controller;

use Agent\Controller\BaseController;

/**
 * 我的银行卡控制器
 * Created by PhpStorm.
 * @User: LT
 * @Date: 2016/11/16
 * @Time: 21:24
 */
class BankController extends BaseController
{
    /**
     * 我的银行卡
     */
    public function index()
    {
        $user_id = $this->getMyId();
        if (IS_POST) {
        } else {
            $admin = M('bank');
            $list = $admin->where(array('user_id' => $user_id))->select();
            $this->assign('list', $list);
            $this->assign("page_title", "我的银行卡");
            $this->display();
        }
    }

    /**
     * 绑定银行卡
     */
    public function add()
    {
        $db = M("bank");
        $user_id = $this->getMyId();
        //判断该用户是否已注册银行卡
        $result = $db->where("user_id=$user_id")->find();
        if (empty($result)) {
            $bank_name = $_POST['bank_name'];
            //防止用户通过地址栏添加数据
            if (empty($bank_name)) {
                $this->error("非法操作");
            }
            $bank_user = $_POST['bank_user'];
            $bank_account = $_POST['bank_account'];

            //检验银行卡号是否已经存在
            $test_account = $db->where(array('bank_account' => $bank_account))->find();
            if (empty($test_account)) {
                $data = array(
                    'bank_name' => $bank_name,
                    'bank_user' => $bank_user,
                    'bank_account' => $bank_account,
                    'user_id' => $user_id,
                    'add_time' => date("Y-m-d H:i:s", time())
                );
                $rs = $db->data($data)->add();
                if ($rs) {
                    $goto = U("agent/bank/index");
                    $this->success("添加成功", $goto);
                } else {
                    $error = $db->getError();
                    $this->error("添加失败:$error");
                }
            } else {
                $this->error("该银行卡号已被注册");
                exit;
            }

        } else {
            $this->error("非法操作");
        }
    }

    /*
    * 删除操作
    */
    public function del()
    {
        //id为空时，非法操作
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");
        if (empty($id)) {
            $this->error("非法操作");
        } else {
            //判断该银行卡信息是否属于用户
            $my_id = $this->getMyId();
            if (!$this->is_children($id, $my_id)) {
                $this->error("非法操作");
            }
            $db = M('bank');
            $rs = $db->where("id=$id")->delete();
            if ($rs) {
                $goto = U("agent/bank/index");
                $this->success("删除成功", $goto);
            } else {
                $this->error("删除失败");
            }
        }
    }

    /**
     * 修改银行卡信息
     */
    public function edit()
    {
        $id = $_POST['id'];
        //判断修改id是否存在
        if (empty($id)) {
            $this->error("非法操作");
        } else {
            //判断该银行卡信息是否属于用户
            $my_id = $this->getMyId();
            if (!$this->is_children($id, $my_id)) {
                $this->error("非法操作");
            }
            $db = M('bank');
            $bank_name = $_POST['bank_edit_name'];
            $bank_user = $_POST['bank_edit_user'];
            $bank_account = $_POST['bank_edit_account'];

            //检验银行卡号是否已经存在
            $condition_account['bank_account'] = $bank_account;
            $condition_account['id'] = array('neq', $id);
            $test_account = $db->where($condition_account)->find();
            if (empty($test_account)) {
                $data = array(
                    'bank_name' => $bank_name,
                    'bank_user' => $bank_user,
                    'bank_account' => $bank_account,
                    'add_time' => date("Y-m-d H:i:s", time())
                );
                //更新数据
                $rs = $db->where("id=$id")->save($data);
                if ($rs) {
                    $goto = U("agent/bank/index");
                    $this->success("修改成功", $goto);
                } else {
                    $error = $db->getError();
                    $this->error("修改失败:$error");
                }
            } else {
                $this->error("该银行卡号已被注册");
                exit;
            }

        }
    }

    /**
     * 判断银行卡是否是属于我的
     * @param $child_id
     * @param $parent_id
     * @return bool
     */
    public function is_children($child_id, $parent_id)
    {
        $obj = M("bank");
        $my_data = $this->getUser();
        $my_id = $my_data['id'];
        $has = $obj->where(array('id' => $child_id, 'user_id' => $parent_id))->find();
        if (empty($has)) {
            return false;
        }
        return true;
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
}
