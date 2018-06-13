<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Model;

/*
 * 评论管理
 * Create by Phpstrom
 * User:lzp
 * Date:16/11/10
 * Time: 00:00
 * Description:评论管理
 */
class CommentController extends BaseController {
    /*
     * 用户评论列表
     */
    public function index() {
        session("search_key",null);  //清空会话值
        $count = M('house_comments')->count();      //求数据总数
        $page_size =C("PAGE_SIZE");
        $page = isset($_GET['p']) ?$_GET['p'] :1;
        $Page = new \Common\Util\MyPage($count,$page_size);     //分页类
        $show = $Page->show();
        $this->assign("page",$show);
        //调用
        $this->pending_num();
        //查找数据
        $date = M()->table('tf_house_comments as comment')->join('tf_house as house on comment.house_id=house.id')->join('tf_user as user on comment.user_id=user.id')->field('comment.id,comment.add_time,comment.status,comment.content,comment.ip,house.title,user.name')->order('id desc')->page($page,$page_size)->select();
        $this->assign("page_title","评论列表");
        $this->assign("date",$date);
        $this->display('comment');

    }
    /*
     * 评论修改页面
     */
    public function comment_edit() {
        $date = new Model();
        $id = isset($_GET['id']) ?$_GET['id'] :"";
        if($id == "") {
            $this->error("没有请求数据");
        } else {
            $sql = "SELECT tf_house_comments.id,tf_house_comments.house_id,tf_house_comments.score,tf_house_comments.green_score,tf_house_comments.traffic_score,tf_house_comments.prop_score,tf_house_comments.content,tf_house_comments.add_time,tf_house_comments.ip,tf_house_comments. STATUS,tf_user.NAME,tf_house.title from tf_house_comments,tf_user,tf_house WHERE tf_house_comments.user_id = tf_user.id AND tf_house_comments.house_id = tf_house.id and tf_house_comments.id=$id";
            $date = $date->query($sql);
            $this->assign("page_title","修改评论");
            $this->assign("date",$date);
            $this->display();
        }
    }
    /*
     * 评论修改操作
     */
    public function comment_update() {
        $db = M('house_comments');
        //获取
        $id = isset($_POST['id']) ?$_POST['id'] :"";
        if(trim($id) == ""){
            $this->error("非法操作！");
        } else {
            $content = $_POST['content'];
            $traffic = $_POST['traffic'];
            $green = $_POST['green'];
            $prop = $_POST['prop'];
            $score = $_POST['score'];
            $audit = $_POST['audit'];
            $ip = $_POST['ip'];
            //传入
            $date['content'] = $content;
            $date['status'] = $audit;
            $date['green_score'] = $green;
            $date['prop_score'] = $prop;
            $date['traffic_score'] = $traffic;
            $date['score'] = $score;
            $date['ip'] = $ip;
            $rs = $db->where("id=$id")->save($date);
            if($rs){
                $this->success("修改成功",U('comment/index'));
            }else{
                $this->error("修改失败");
            }
        }

    }
    /*
     * 删除评论操作
     */
    public function comment_del()
    {
        $id = $_GET['id'];
        $db = M('house_comments');
        $rs = $db->where("id=$id")->delete();
        if($rs){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    /*
     * 删除多条评论操作
     */
    public function comment_delall() {
        $db = M('house_comments');
        $id = $_POST['checkbox'];
        $row = '';
        foreach ($id as $val){
            $row .=','. $val;
        }
        $row = trim($row,',');
        $rs = $db->delete($row);
        if($rs){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }
    /*
     * 评论审核操作
     */
    public function comment_audit() {
        $db = M('house_comments');
        $status = $_POST['audit'];
        $id = I("post.id","","trim");
        $date['status'] = $status;
        $rs = $db->where("id=$id")->save($date);
        if($rs){
            $this->success("操作成功");
        }else{
            $this->error("操作失败");
        }
    }
    /*
     * 搜索
     */
    public function comment_select() {
        //获取数据 并判断
        $val = $_POST['find'];
        $val = trim($val);
        if (!empty($val)) {
            session('search_key',$val);
        }
        $val = empty($val) ? session('search_key') : $val;
        $page = isset($_GET['p']) ?$_GET['p'] :1;
        if (empty($val)) {
            $sql = "SELECT a.id,c.title,a.content,b.name,c.title from tf_house_comments as a,tf_user as b,tf_house as c where a.user_id = b.id AND a.house_id=c.id ";
        } else {
            $sql = "SELECT a.id,c.title,a.content,b.name,c.title from tf_house_comments as a,tf_user as b,tf_house as c where a.user_id = b.id AND a.house_id=c.id AND (a.content LIKE '%$val%' OR b.name LIKE '%$val%' OR c.title LIKE '%$val%')";
        }
        //求总数
        $arr = M()->query($sql);
        $count = count($arr);
        //分页
        $page_size = C("PAGE_SIZE");
        $date = M()->table('tf_house_comments as a')->join('tf_house as b on a.house_id=b.id')->join('tf_user as c on a.user_id=c.id')->field('a.id,a.add_time,a.status,a.ip,a.content,b.title,c.name')->where("a.content like '%$val%' or b.title like '%$val%' or c.name like '%$val%'")->order('id desc')->page($page,$page_size)->select();
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("val",$val);
        $this->assign("page",$show);
        $this->pending_num();
        $this->assign("date",$date);
        $this->assign("page_title","评论列表");
        $this->display('comment');
    }
    /*
     * 根据审核状态筛选数据
     */
    public function audit() {
        $status = I('get.status',"",'trim');
        $page_size =C("PAGE_SIZE");
        $page = I('get.p',"1"); //获取页码
        $count = M('house_comments')->where("status='$status'")->count(); //获取数据总数
        $Page = new \Common\Util\MyPage($count,$page_size);     //分页类
        $show = $Page->show();          //分页输出
        $date = M()->table('tf_house_comments as comment')->join('tf_house as house on comment.house_id=house.id')->join('tf_user as user on comment.user_id=user.id')->field('comment.id,comment.add_time,comment.status,comment.content,comment.ip,house.title,user.name')->where("comment.status='$status'")->order('id desc')->page($page,$page_size)->select();
        $this->assign("page",$show);
        $this->pending_num();  //调用
        $this->assign("page_title","评论列表");
        $this->assign("date",$date);
        $this->display('comment');
    }
    /*
     * 未审核数据数量显示
     */
    public function pending_num() {
        $num = M('house_comments')->where("status='pending'")->count();
        $this->assign('num',$num);
    }
    /*
     * 析构函数
     */
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        session("search_key",null);
    }
}