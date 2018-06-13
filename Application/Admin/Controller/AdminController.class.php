<?php
/**
 * Created by PhpStorm.
 * User: 郑宇贺
 * Date: 2016/11/10
 * Time: 15:12
 */

namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Controller;


class AdminController extends BaseController
{
    /**
     * 管理员列表
     */
    public function index()
    {
        $this->assign("page_title", "管理员列表");
        $admin = M('admin');

        //筛选数据
        $count = $admin->count();
        $Page = new \Think\Page($count,5);
        $show = $Page->show();
        $data = $admin->where("is_super_admin=0")->limit($Page->firstRow.','.$Page->listRows)->select();
        $role=M('admin_role');
        $data2=$role->select();
        $this->assign('role',$data2);
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $this->assign('data',$data);
        $this->assign('page',$show);
        $this->display();
    }

    /**
     *角色列表
     */
    public function role()
    {
        $this->assign("page_title", "角色设置");
        $role = M('admin_role');
        $data = $role->select();
        $this->assign('data',$data);
        $this->display();


    }

    /**
     *跳转到添加管理员页面
     */
    public function add() {
        $this->assign("page_title", "添加管理员");

        $role = M('admin_role');

        //筛选数据


        $data = $role->where("enabled=1")->select();


        $this->assign('role',$data);

        $this->display();

    }

    /**
     * 角色添加
     */
    public function role_add() {
        $data= array(
            'name'=>$_POST['name'],
            'enabled'=>$_POST['enabled'],
            'description'=>$_POST['description']
        );
        $role = M('admin_role');
        $rs = $role->data($data)->add();
        if ($rs) {
            $this->success("添加成功", 'admin.php?m=Admin&c=admin&a=role', 3);
        } else {
            $this->error("添加失败");
        }
    }

    /**
     *角色修改
     */
    public function role_update() {
        $id = $_GET['id'];
        $this->assign("page_title", "角色修改");
        $admin = M('admin_role');
        $data = $admin->where("`id` = $id")->select();

        $this->assign('role', $data[0]);
        $this->display("role-add");

    }

    /**
     * 角色修改保存
     */
    public function role_save() {
        $id=$_GET['id'];
        $data= array(
            'name'=>$_POST['name'],
            'enabled'=>$_POST['enabled'],
            'description'=>$_POST['description']
        );
        $role = M('admin_role');

        $rs = $role->data($data)->where("`id` = $id")->save();


        if ($rs) {
            $this->success("修改成功", 'admin.php?m=Admin&c=admin&a=role',3);
        } else {
            $this->error("修改失败");
        }

    }

    /**
     * 管理员添加保存
     */

    public function inset() {
        $data = array(
            'name' => $_POST['name'],
            'pwd' => md5($_POST['pwd']),
            'nickname' => $_POST['nickname'],
            'email' => $_POST['email'],
            'realname' => $_POST['realname'],
            'role_id' => $_POST['role_id'],
        );
        $realname=$_POST['realname'];
        $admin = M('admin');
        $sel=$admin->where("realname= '$realname' ")->count();
        if($sel==0){
            $rs = $admin->data($data)->add();
            if ($rs) {
                $this->success("添加成功", 'admin.php?m=Admin&c=admin&a=index', 3);
            } else {
                $this->error("添加失败");
            }
        }else{
            $this->error("已存在该管理员");
            
        }


    }

    /**
     *管理员修改
     */
    public function update()
    {
        $id = $_GET['id'];
        $this->assign("page_title", "管理员修改");
        $admin = M('admin');
        $data = $admin->where("`id` = $id")->select();
        $data=json_encode($data, JSON_UNESCAPED_UNICODE);
        $this->assign('data', $data);
        $role = M('admin_role');

        //筛选数据


        $data2 = $role->where("enabled=1")->select();


        $this->assign('role',$data2);
        $this->assign('pwd',0);
        $this->display("add");


    }

    /**
     *
     * 管理员修改保存
     */
    public function save() {
        $id=$_GET['id'];

        $data = array(
            'name' => $_POST['name'],
            'realname' => $_POST['realname'],
            'role_id' => $_POST['role_id'],

        );
        $pwd=md5($_POST['pwd']);
        if($pwd!==""){
            $data['pwd']=$pwd;

        }


        $admin = M('admin');
        $rs = $admin->data($data)->where("`id` = $id")->save();

        if ($rs) {
            $this->success("修改成功", 'admin.php?m=Admin&c=admin&a=index', 3);
        } else {
            $this->error("您未修改任何数据");
        }

    }
    /*
     * 管理员搜索
     */
    public function search()
    {
        $str = $_GET['str'];
        $admin = D("admin");

        $data = $admin->where("`name` like '%$str%' and is_super_admin=0")->select();
        $this->assign("page_title", "管理员搜索");

        $this->assign('data',$data);

        $this->display("index");


    }

    /**
     * 管理员删除
     */


    public function delrow(){
        $check=$_GET['mychk'];
        $where=implode(',',$check );

        $admin=M("admin");
        $data=$admin->where("id IN ($where)")->delete();
        if ($data) {
            $this->success("删除成功", 'admin.php?m=Admin&c=admin&a=index', 3);
        } else {
            $this->error("删除失败");
        }
    }

    /**
     * 角色删除
     */
    public function role_del(){
        $check=$_GET['mychk'];
        $where=implode(',',$check );

        $admin_role=M("admin_role");
        $data=$admin_role->where("id IN ($where)")->delete();
        if ($data) {
            $this->success("删除成功", 'admin.php?m=Admin&c=admin&a=role', 3);
        } else {
            $this->error("删除失败");
        }
    }

    /**
     * 保存权限
     */
    public function right(){
        $role_id = $_GET['id'];
        $rights = $_POST['rights'];
        $data = serialize($rights);
        $rs = M("admin_role")->where("id=$role_id")->data(array('rights'=>$data))->save();
        if ($rs) {
            $this->success("修改权限成功",'admin.php?m=Admin&c=admin&a=role', 3);
        } else {
            $this->error("修改权限失败");
        }

    }

    /**
     * 权限设置
     */
    public function role_right() {
        //获取菜单
        $menus = C("MENU");
        $this->assign("menu", $menus);

        $id = $_GET['id'];
        $this->assign("id", $id);
        $this->assign("page_title", "权限设置");
        $this->display("role_right");
    }

}