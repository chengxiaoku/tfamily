<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;
use Think\Model;
use Common\Util;

/**
 * Created by PhpStorm
 * Class MoneyController
 * User:hyh
 * Date:2016/11/10
 * Time:17:53
 * Description:描述
 */
class MoneyController extends BaseController {

    public function index(){
        //清空session
        session("money_type",null);
        session("money_time",null);
        //页面标题
        $this->assign("page_title", "资金明细");
        $obj = M('money_details');
        $page_size = C('PAGE_SIZE');
        //获取当前用户id
        $user=$this->getUser();
        $user_id=$user['id'];
        $count = $obj->where("user_id=$user_id")->count();
        $page = isset($_GET['p']) ?$_GET['p'] :1;
        $Page = new Util\MyPage($count,$page_size);
        $show = $Page->show();
        //筛选数据
        $data = M()->table('tf_money_details as moneys')->join('tf_user as user on moneys.user_id=user.id')->field('moneys.id,moneys.add_time,moneys.status,moneys.money,moneys.real_money,moneys.description,moneys.do_type,moneys.integray,user.name,user.tel' )->page($page,$page_size)->where('moneys.user_id='.$user_id.'')->order('moneys.add_time DESC')->select();
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $this->assign('data',$data);
        $this->assign('page',$show);
        //渲染模板
        $this->display("index");
    }

    /**
     *查看明细
     */
    public function money_details() {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");;
        //筛选数据
        $data = M()->table('tf_money_details as moneys')->join('tf_user as user on moneys.user_id=user.id')->field('moneys.id,moneys.add_time,moneys.status,moneys.money,moneys.description,moneys.do_type,moneys.real_money,moneys.integray,user.name,moneys.remark,user.tel')->where('moneys.id='.$id.'')->select();
        echo json_encode($data);
    }
    /*
     * 搜索
     */
    public function money_search(){
        //获取当前用户id
        $user=$this->getUser();
        $user_id=$user['id'];
        $do_type = trim(!empty($_POST['do_type'])?$_POST['do_type']:"");
        $add_time = trim(!empty($_POST['add_time'])?$_POST['add_time']:"");
        //session赋值
        if (!empty($do_type)) {
            session('money_type',$do_type);
        }
        if (!empty($add_time)) {
            session('money_time',$add_time);
        }
        $do_type = empty($do_type) ? session('money_type') : $do_type;
        $add_time = empty($add_time) ? session('money_time') : $add_time;
        $page = isset($_GET['p']) ?$_GET['p'] :1;
        $page_size = C('PAGE_SIZE');
        $where="";
        //搜索数据
        if ($add_time != ''){
            $where = " AND moneys.add_time LIKE '$add_time%'" ;
        }
        if ($do_type != ''){
            $where = "  $where  AND moneys.do_type = '$do_type' " ;
        }
        $data = M()->table('tf_money_details as moneys')->join('tf_user as user on moneys.user_id=user.id')->field('moneys.id,moneys.add_time,moneys.status,moneys.money,moneys.real_money,moneys.description,moneys.do_type,moneys.integray,user.name,user.tel' )->page($page,$page_size)->where("moneys.user_id=$user_id $where")->order('moneys.add_time DESC')->select();
        $count = M()->table('tf_money_details as moneys')->join('tf_user as user on moneys.user_id=user.id')->field('moneys.id,moneys.add_time,moneys.status,moneys.money,moneys.real_money,moneys.description,moneys.do_type,moneys.integray,user.name,user.tel' )->where("moneys.user_id=$user_id $where")->count();
        $Page = new Util\MyPage($count,$page_size);
        $show = $Page->show();
        if(empty($data)){
            echo "<script type=\"text/javascript\"> alert('无相关记录'); location.href = 'agent.php?m=Agent&c=money&a=index';</script>";
        }
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $this->assign("page_title", "资金明细->搜索");
        $this->assign("data",$data);
        $this->assign('page',$show);
        //渲染模板
        $this->display('index');
    }

}

