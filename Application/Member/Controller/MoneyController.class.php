<?php
namespace Member\Controller;
use Member\Controller\BaseController;
use Think\Model;
use Common\Util\MyPage;
/**
 * Created by PhpStorm
 * Class MoneyController
 * User:hdj
 * Date:2016/11/10
 * Time:17:53
 * Description:描述
 */
class MoneyController extends BaseController{

    public function index()
    {

        //获取当前用户id
        $user = $this->getUser();
        $user_id = $user['id'];
        //页面标题
        $this->assign("page_title", "资金明细");
        //获取数据总数
        $count_sql = "SELECT t1.*, t2.tel FROM tf_money_details t1 LEFT JOIN tf_user t2 ON t1 .user_id = t2.id  WHERE t1.user_id=" . $user_id . " ORDER BY id DESC";
        $db = M();
        $rs_count = $db->query($count_sql);
        //筛选数据
        //limit xx, xx
        $p = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C("PAGE_SIZE");
        $offset = ($p - 1) * $page_size;
        $sql = "SELECT t1.*,t2.name FROM tf_money_details t1 LEFT JOIN tf_user t2 ON t1.user_id = t2.id  WHERE t1.user_id=" . $user_id . "  ORDER BY id DESC   LIMIT $offset, $page_size";
        $rs = $db->query($sql);
        $this->assign("data", $rs);
        //分页
        $rows_count = count($rs_count);
        $pager = new MyPage($rows_count, $page_size);
        $page = $pager->show();
        $this->assign("page", $page);

        $this->assign("page_title", "资金明细");
        $this->display();
    }

    public function money_details()
    {
        $id = trim(isset($_GET['id']) ? $_GET['id'] : "");;
        //筛选数据
        $data = M()->table('tf_money_details as moneys')->
        join('tf_user as user on moneys.user_id=user.id')->
        field('moneys.id,moneys.add_time,moneys.status,
        moneys.money,moneys.description,moneys.do_type,
        moneys.integray,user.name,user.tel')->where('moneys.id=' . $id . '')->
        select();
        echo json_encode($data);
    }

    /*
     * 搜索
     */
    public function money_search()
    {

        $this->assign("page_title", "资金明细");
        //获取当前用户id
        $user = $this->getUser();
        $user_id = $user['id'];
        $do_type = trim(!empty($_POST['do_type']) ? $_POST['do_type'] : "");
        $add_time = trim(!empty($_POST['add_time']) ? $_POST['add_time'] : "");
        if (!empty($do_type)) {
            session('money_type', $do_type);
        }
        if (!empty($add_time)) {
            session('money_time', $add_time);
        }
        $do_type = empty($do_type) ? session('money_type') : $do_type;
        $add_time = empty($add_time) ? session('money_time') : $add_time;
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C('PAGE_SIZE');
        $where = "";
        //搜索数据
        if ($add_time != '') {
            $where = " AND moneys.add_time LIKE '$add_time%'";
        }
        if ($do_type != '') {
            $where = "  $where  AND moneys.do_type = '$do_type' ";
        }
        $data = M()->table('tf_money_details as moneys')->
        join('tf_user as user on moneys.user_id=user.id')->
        field('moneys.id,moneys.add_time,moneys.status,moneys.money,moneys.real_money,
        moneys.description,moneys.do_type,moneys.integray,user.name,user.tel')->
        page($page, $page_size)->where("moneys.user_id=$user_id $where")->
        order('moneys.id DESC')->select();

        $count = M()->table('tf_money_details as moneys')->
        join('tf_user as user on moneys.user_id=user.id')->
        field('moneys.id,moneys.add_time,moneys.status,moneys.money,
        moneys.real_money,moneys.description,moneys.do_type,moneys.integray,
        user.name,user.tel')->
        where("moneys.user_id=$user_id $where")->count();
        $Page = new MyPage($count, $page_size);
        if(empty($data)){
            echo "<script type=\"text/javascript\"> alert('当前无消费记录'); location.href = 'member.php?m=Member&c=money&a=index';</script>";
        }

        $show = $Page->show();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $this->assign("page_title", "搜索");
        $this->assign("data", $data);
        $this->assign('page', $show);
        //渲染模板
        $this->display('index');
    }
    
}