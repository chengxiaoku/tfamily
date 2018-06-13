<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Common\Util;

/**
 * 栏目管理控制器
 * Class IndexController
 * @package Admin\Controller
 * @author dyy
 * @date 2016-11-11
 */
header('content-type:text/html;charset=utf-8');
class CategoryController extends BaseController
{
    /**
     * 首页
     */
    public function index()
    {
        $Category = M('category');
        //拉取数据
        if (!empty($_GET['like'])) {
            $like = '"%' . $_GET['like'] . '%"';
            $sql = "select * from tf_category where name like $like order by order_by asc";
            $rs = $Category->query($sql);
            $this->assign('content', $rs);
        } else {
            $sql = "select * from tf_category order by order_by asc";
            $rs = $Category->query($sql);
            $tree = new \Common\Util\Tree($rs);
            $rs1 = $tree->get_descendant(0);
            $this->assign('content', $rs1);
        }
        //页面标题
        $this->assign("page_title", "栏目管理");
        //渲染模板
        $this->display();
    }

    /**
     * 添加栏目
     */
    public function add()
    {
        $Category = M('category');
        //拉取分类列表
        $sql1 = 'select id,name from tf_category';
        $rs1 = $Category->query($sql1);
        $this->assign('category', $rs1);
        if (isset($_GET['id'])) {
            //拉取数据
            $sql = 'select * from tf_category where id=' . $_GET['id'];
            $rs = $Category->query($sql);
            $this->assign('row', $rs[0]);
            //页面标题
            $this->assign("page_title", "编辑栏目");
            //渲染模板
            $this->display("add");
        } else if (isset($_GET['pid'])) {
            $this->assign('pid', $_GET['pid']);
            $this->assign("page_title", "添加子栏目");
            //渲染模板
            $this->display("add");
        } else {
            //页面标题
            $this->assign("page_title", "添加栏目");
            //渲染模板
            $this->display("add");
        }
    }

    /**
     * 添加单网页
     */
    public function addPage()
    {
        $Category = M('category');
        if (isset($_GET['id'])) {
            //拉取数据
            $sql = 'select * from tf_category where id=' . $_GET['id'];
            $rs = $Category->query($sql);
            $content = htmlspecialchars_decode($rs[0]['content']);
            $rs[0]['content'] = $content;
            $this->assign('row', $rs[0]);
            //页面标题
            $this->assign("page_title", "修改单页面");
            //渲染模板
            $this->display("addPage");
//        } else if (isset($_GET['pid'])) {
//            echo '<script>alert("没有父分类");history.go(-1);</script>';
//            $this->assign('pid', $_GET['pid']);
//            //页面标题
//            $this->assign("page_title", "添加子单页面");
//            //渲染模板
//            $this->display("addPage");
        } else {
            //页面标题
            $this->assign("page_title", "添加单页面");
            //渲染模板
            $this->display("addPage");
        }
    }

    /**
     * 添加外部链接
     */
    public function addLink()
    {
        $Category = M('category');
        //拉取分类列表
        $sql1 = 'select id,name from tf_category';
        $rs1 = $Category->query($sql1);
        $this->assign('category', $rs1);
        if (isset($_GET['id'])) {
            //拉取数据
            $sql = 'select * from tf_category where id=' . $_GET['id'];
            $rs = $Category->query($sql);
            $this->assign('row', $rs[0]);
            //页面标题
            $this->assign("page_title", "编辑外部链接");
            //渲染模板
            $this->display("addLink");
        } else if (isset($_GET['pid'])) {
            $this->assign('pid', $_GET['pid']);
            $this->assign("page_title", "添加子外部链接");
            //渲染模板
            $this->display("addLink");
        } else {
            //页面标题
            $this->assign("page_title", "添加外部链接");
            //渲染模板
            $this->display("addLink");
        }

    }

    /**
     * 删除栏目
     */
    public function del()
    {
        $Category = M('category');
        $sql = 'delete from tf_category where   id=' . $_GET['id'];
        $rs = $Category->execute($sql);
        if ($rs == 1) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /***
     * 栏目，单网页，外链接
     * 添加，添加子，编辑
     */
    public function DoAdd()
    {
        $Category = M('category');
        $id = 'null';
        $parentid = 'null';
        $ancestor = 'null';
        $thumb = 'null';
        $name = 'null';
        $description = 'null';
        $ismenu = 'null';
        $add_time = '"' . date('Y-m-d H-i-s', time()) . '"';
        $type = '"category"';
        $content = 'null';
        $order_by = 1;
//        给值两边加单引号
        function str($a){
            $b = "'".$a."'";
            return $b;
        }
        if ($_GET['do'] == 'upd') {
            $id = $_GET['id'];
            $name  = str($_POST['name']);
            $parentid = $_POST['parentid'];
            $thumb = str($_POST['thumb']);
            $description = str($_POST['description']);
            $ismenu = $_POST['ismenu'];
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "update tf_category set name = $name,parentid = $parentid,thumb = $thumb,description = $description,ismenu = $ismenu,ancestor = $ancestor where id = $id";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', '');
            }
        }
        if ($_GET['do'] == 'addc') {
            $name  = str($_POST['name']);
            $parentid = $_POST['parentid'];
            $thumb = str($_POST['thumb']);
            $description = str($_POST['description']);
            $ismenu = $_POST['ismenu'];
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', 'admin.php?m=Admin&c=category&a=index');
            }
        }
        if ($_GET['do'] == 'add') {
            $name  = str($_POST['name']);
            $parentid = $_POST['parentid'];
            $thumb = str($_POST['thumb']);
            $description = str($_POST['description']);
            $ismenu = $_POST['ismenu'];
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
//            插入数据
            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', 'admin.php?m=Admin&c=category&a=index');
            }
        }
    }
    public function DoAddPage()
    {
        $Category = M('category');
        $id = 'null';
        $parentid = 'null';
        $ancestor = 'null';
        $thumb = 'null';
        $name = 'null';
        $description = 'null';
        $ismenu = 'null';
        $add_time = '"' . date('Y-m-d H-i-s', time()) . '"';
        $type = '"page"';
        $content = 'null';
        $order_by = '1';
        //        给值两边加单引号
        function str($a){
            $b = "'".$a."'";
            return $b;
        }


        if ($_GET['do'] == 'upd') {
            $id = $_GET['id'];
            $name = str($_POST['name']);
            $thumb = str($_POST['thumb']);
            $content = str($_POST['content']);
            $ismenu = $_POST['ismenu'];
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "update tf_category set name = $name,thumb = $thumb,content = $content,ismenu = $ismenu, ancestor = $ancestor where id = $id";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', '');
            }
        }

//        if ($_GET['do'] == 'addc') {
//            $name = str($_POST['name']);
//            $thumb = str($_POST['thumb']);
//            $content = str($_POST['content']);
//            $ismenu = $_POST['ismenu'];
//            //找父栏目的祖先
//            $sql = "select ancestor from tf_category where id = $parentid";
//            $rs = $Category->query($sql);
//            //拼接父栏目的祖先和id
//            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
//            $ancestor = str($ancestor);
//            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
//            $rs1 = $Category->execute($sql1);
//            if ($rs1 == 1) {
//                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
//            } else {
//                $this->error('修改失败', 'admin.php?m=Admin&c=category&a=index');
//            }
//        }
        
        if ($_GET['do'] == 'add') {
            $name = str($_POST['name']);
            $thumb = str($_POST['thumb']);
            $content = str($_POST['content']);
            $ismenu = $_POST['ismenu'];
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('添加成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('添加失败', 'admin.php?m=Admin&c=category&a=index');
            }
        }
    }
    public function DoAddLink()
    {
        $Category = M('category');
        $id = 'null';
        $parentid = 'null';
        $ancestor = 'null';
        $thumb = 'null';
        $name = 'null';
        $description = 'null';
        $ismenu = 'null';
        $add_time = '"' . date('Y-m-d H-i-s', time()) . '"';
        $type = '"link"';
        $content = 'null';
        $order_by = '1';
        //        给值两边加单引号
        function str($a){
            $b = "'".$a."'";
            return $b;
        }
        if ($_GET['do'] == 'upd') {
            $id = $_GET['id'];
            $parentid = $_POST['parentid'];
            $name = str($_POST['name']);
            $thumb = str($_POST['thumb']);
            $content = str($_POST['content']);
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "update tf_category set name = $name,parentid = $parentid,thumb = $thumb,content = $content, ancestor = $ancestor where id = $id";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', '');
            }
        }
        if ($_GET['do'] == 'addc') {
            $parentid = $_POST['parentid'];
            $name = str($_POST['name']);
            $thumb = str($_POST['thumb']);
            $content = str($_POST['content']);
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', 'admin.php?m=Admin&c=category&a=index');
            }
        }
        if ($_GET['do'] == 'add') {
            $parentid = $_POST['parentid'];
            $name = str($_POST['name']);
            $thumb = str($_POST['thumb']);
            $content = str($_POST['content']);
            //找父栏目的祖先
            $sql = "select ancestor from tf_category where id = $parentid";
            $rs = $Category->query($sql);
            //拼接父栏目的祖先和id
            $ancestor = $rs[0]['ancestor'].'/'.$parentid;
            $ancestor = str($ancestor);
            $sql1 = "insert into tf_category values ($id,$parentid,$ancestor,$thumb,$name,$description,$ismenu,$add_time,$type,$content,$order_by)";
            $rs1 = $Category->execute($sql1);
            if ($rs1 == 1) {
                $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
            } else {
                $this->error('修改失败', 'admin.php?m=Admin&c=category&a=index');
            }
        }
    }

    /**
     * 添加子栏目，编辑 转到添加页面类
     */
    public function  upd(){
        if($_GET['type'] == 'category'){
            $this->add();
        }else if($_GET['type'] == 'page'){
            $this->addPage();
        }else{
            $this->addLink();
        }
    }

    /**
     * 排序
     */
    public function order()
    {
        $Category = M('category');
        $sql = 'select id,order_by from tf_category';
        $rs = $Category->query($sql);
        foreach ($rs as $key=>$val){
            $id = $val['id'];
            $order_by = $val['order_by'];
            $new_order = $_POST[$id];
            if ($order_by !== $new_order){
                $sql1 = "update tf_category set order_by = $new_order where id = $id";
                $rs1 = $Category->execute($sql1);
            }
        }
        $this->success('修改成功', 'admin.php?m=Admin&c=category&a=index');
    }

    //判断名称重复
    public function is(){
        $Category = M('category');
        $sql = 'select name from tf_category';
        $rs = $Category->query($sql);
        foreach ($rs as $key => $val){
            if ($val['name'] == $_GET['name']){
                echo 1;
                exit;
            }
        }
    }
}