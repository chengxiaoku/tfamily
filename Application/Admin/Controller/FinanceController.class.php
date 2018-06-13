<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;

/**
 * 财务管理控制器
 * user：王天棋
 * Date：2016/11/9
 * Time:16:49
 * Class FinanceController
 * @package Admin\Controller
 * @author xxx@qq.com
 * @date 2016-11-11
 */
class FinanceController extends BaseController
{
    /**
     * 首页
     */
    public function index()
    {
        $tf_finance = M('money_details');
        $tf_level = M('level');
        $tf_user = M('user');

        $type = C(BUSINESS_TYPE);
        $this->assign("type", $type);

        $data_money_details = $tf_level->select();
        $this->assign("level", $data_money_details);
        
        //获取页码
        $page = isset($_GET['page']) ? $_GET['page'] : '1';
        if ($page) {
        } else {
            $page = 1;
        }
        //判断
        $pdd=isset($_GET['pdd'])?$_GET['pdd']:'';
        $Model = new \Think\Model();// 实例化一个model对象 没有对应任何数据表
        //如果检索内容有值
        if ($pdd=='yes') {
            //获取检索的所有条件
            $sour_lv=isset($_GET['so1'])?$_GET['so1']:'';
            $sour_type=isset($_GET['so2'])?$_GET['so2']:'';
            $sour_time=isset($_GET['so3'])?$_GET['so3']:'';
            $sour_name=isset($_GET['so4'])?$_GET['so4']:'';
            $this->assign("so1",$sour_lv);
            $this->assign("so2",$sour_type);
            $this->assign("so3",$sour_time);
            $this->assign("so4",$sour_name);
            session("finance_search_name",$sour_name);
            session("finance_search_time",$sour_time);


            //对获取检索到的条件进行判断
            if ($sour_lv == '所有角色') {
                $sour_lv = '';
            }
            if ($sour_type == '所有类型') {
                $sour_type = '';
            }
            if ($sour_time == '所有年份') {
                $sour_time = '';
            }

            foreach ($type as $key => $ty) {
                if ($sour_type == $ty) {
                    $sour_type = $key;
                }
            }
            session("finance_search_level_id",$sour_type);





            $data_level = $Model->query(" SELECT * FROM `tf_level` WHERE ( name like '$sour_lv')");
            foreach ($data_level as $l) {
                $level_id = $l['id'];
            }
            session("finance_search_level_id",$level_id);
            if ($level_id){
                if ($sour_name){
                    $data_user=$Model->query(" SELECT * FROM `tf_user` WHERE ( name like '%$sour_name%' AND level_id LIKE '$level_id')");
                }else{
                    $data_user=$Model->query(" SELECT * FROM `tf_user` WHERE ( level_id LIKE '$level_id')");
                }
            } else {
                if ($sour_name) {
                    $data_user = $Model->query(" SELECT * FROM `tf_user` WHERE ( name like '%$sour_name%')");
                } else {
                    $data_user = '';
                }
            }
            $data_money_details_new = array();
            foreach ($data_user as $u) {
                $user_id = $u['id'];
                $new[] = $u['id'];
                if ($sour_type) {
                    if ($sour_time) {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( do_type LIKE '$sour_type' AND add_time LIKE '$sour_time%' AND user_id LIKE '$user_id')ORDER BY id DESC");
                    } else {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( do_type LIKE '$sour_type' AND user_id LIKE '$user_id')ORDER BY id DESC");
                    }
                } else {
                    if ($sour_time) {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( add_time LIKE '$sour_time%' AND user_id LIKE '$user_id')ORDER BY id DESC");
                    } else {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( user_id LIKE '$user_id')ORDER BY id DESC");
                    }
                }
                foreach ($data_money_details as $mo) {
                    $data_money_details_new[] = $mo;
                }

            }//dump($data_money_details);
            if ($user_id) {
            } else {
                if ($sour_type) {
                    if ($sour_time) {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( do_type LIKE '$sour_type' AND add_time LIKE '$sour_time%')ORDER BY id DESC");
                    } else {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE ( do_type LIKE '$sour_type')ORDER BY id DESC");
                    }
                } else {
                    if ($sour_time) {
                        $data_money_details = $Model->query(" SELECT * FROM `tf_money_details` WHERE (add_time LIKE '$sour_time%')ORDER BY id DESC");
                    } else {
                        $data_money_details = '';
                    }
                }
                foreach ($data_money_details as $mo) {
                    $data_money_details_new[] = $mo;
                }
            }
            $new = array();
            $data_user = $tf_user->select();
            $data_level = $tf_level->select();
            //将三张表合并
            foreach ($data_money_details_new as $a) {
                $n_type = $a['do_type'];
                foreach ($type as $key => $ty) {
                    if ($n_type == $key) {
                        $n_type = $ty;
                    }
                }
                $new_type = array('do_type' => $n_type);
                $n_status = $a['status'];
                if ($n_status == 'reject') {
                    $n_status = '拒绝';
                }
                if ($n_status == 'checked') {
                    $n_status = '已审核';
                }
                if ($n_status == 'pending') {
                    $n_status = '待审核';
                }
                if ($n_status == 'revoke') {
                    $n_status = '撤销';
                }
                $new_status = array('status' => $n_status);
                $user_id = $a['user_id'];
                foreach ($data_user as $v) {
                    $level_id = $v['level_id'];
                    $user_name = array("user_name" => $v['name']);
                    if ($user_id == $v['id']) {
                        $no1 = 'ok';
                        foreach ($data_level as $l) {
                            if ($level_id == $l['id']) {
                                $no2 = 'ok';
                                $ll = array("level_name" => $l['name']);
                                $new[] = $new_type + $new_status + $a + $v + $ll + $user_name;
                            }
                        }
                        if ($no2 == 'ok') {
                            $no2 = 'no';
                        } else {
                            $new[] = $new_type + $new_status + $a + $v + $user_name;
                        }
                    }
                }
                if ($no1 == 'ok') {
                    $no1 = 'no';
                } else {
                    $new[] = $new_type + $new_status + $a;
                }
            }
            $zh = count($new);
            $page_size = C('PAGE_SIZE');
            if ($zh > $page_size) {
                $sour_lv = isset($_GET['so1']) ? $_GET['so1'] : '';
                $sour_type = isset($_GET['so2']) ? $_GET['so2'] : '';
                $sour_time = isset($_GET['so3']) ? $_GET['so3'] : '';
                $sour_name = isset($_GET['so4']) ? $_GET['so4'] : '';
                $page_num = array();
                $zy = $zh / $page_size;
                $zy = ceil($zy);
                for ($i = 1; $i <= $zy; $i++) {		
                    $page_num[]='<li id="'.$i.'p" class="paginate_button"><a tabindex="0" data-dt-idx="0" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&so1='.$sour_lv.'&so2='.$sour_type.'&so3='.$sour_time.'&so4='.$sour_name.'&page='.$i.'&pdd=yes" style="width: 34px;">'.$i.'</a></li>';
                }
                $this->assign("allpage", $page_num);
                $star = $page * $page_size - $page_size;
                $new = array_slice($new, $star, $page_size);
                //
                $ppage = $page - 1;
                if ($ppage <= 1) {
                    $ppage = 1;
                }
                $this->assign("ppage", $ppage);
                $npage = $page + 1;
                if ($npage >= $zy) {
                    $npage = $zy;
                }
                $wid=34*$zy-$zy+1;
                $this->assign("wid",$wid);
               if($zy>=5){
	        $wid2=34*5;
                $this->assign("wid2",$wid2);
	    }else{
	        $wid2=34*$zy;
                $this->assign("wid2",$wid2);
	    }

                $this->assign("page", $page);
                $this->assign("zy", $zy);
                $this->assign("prev", '<a tabindex="0" data-dt-idx="0" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&so1='.$sour_lv.'&so2='.$sour_type.'&so3='.$sour_time.'&so4='.$sour_name.'&page='.$ppage.'&pdd=yes">上一页</a>');
                $this->assign("next", '<a tabindex="0" data-dt-idx="7" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&&so1='.$sour_lv.'&so2='.$sour_type.'&so3='.$sour_time.'&so4='.$sour_name.'&page='.$npage.'&pdd=yes">下一页</a>');
            }else{}

            $this->assign("user", $new);
            //页面标题
            $this->assign("page_title", "财务管理");
            //渲染模板
            $this->display();
        } else {

            //分页
            $data = $Model->query("select COUNT(*) from tf_money_details");
            foreach ($data as $p) {
                $zh = $p['count(*)'];
            }
            $page_size = C('PAGE_SIZE');
            $zy = $zh / $page_size;
            $zy = ceil($zy);
            //把页码生成数组并传递过去
            for ($i = 1; $i <= $zy; $i++) {	    
                $new[]='<li id="'.$i.'p" class="paginate_button"><a tabindex="0" data-dt-idx="0" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&page='.$i.'" style="width: 34px;">'.$i.'</a></li>';
            }
            $this->assign("allpage", $new);
            $new = array();
            //拉取数据
            $star = $page * $page_size - $page_size;
            $data_money_details = $tf_finance->order('id DESC')->limit($star, $page_size)->select();
            $data_user = $tf_user->select();
            $data_level = $tf_level->select();
            //将三张表合并
            foreach ($data_money_details as $a) {
                $n_type = $a['do_type'];
                foreach ($type as $key => $ty) {
                    if ($n_type == $key) {
                        $n_type = $ty;
                    }
                }
                $new_type = array('do_type' => $n_type);
                $n_status = $a['status'];
                if ($n_status == 'reject') {
                    $n_status = '拒绝';
                }
                if ($n_status == 'checked') {
                    $n_status = '已审核';
                }
                if ($n_status == 'pending') {
                    $n_status = '待审核';
                }
                if ($n_status == 'revoke') {
                    $n_status = '撤销';
                }
                $new_status = array('status' => $n_status);
                $user_id = $a['user_id'];
                foreach ($data_user as $v) {
                    $level_id = $v['level_id'];
                    $user_name = array("user_name" => $v['name']);
                    if ($user_id == $v['id']) {
                        $no1 = 'ok';
                        foreach ($data_level as $l) {
                            if ($level_id == $l['id']) {
                                $no2 = 'ok';
                                $ll = array("level_name" => $l['name']);
                                $new[] = $new_type + $new_status + $a + $v + $user_name + $ll;
                            }
                        }
                        if ($no2 == 'ok') {
                            $no2 = 'no';
                        } else {
                            $new[] = $new_type + $new_status + $a + $v + $user_name;
                        }
                    }

                }
                if ($no1 == 'ok') {
                    $no1 = 'no';
                } else {
                    $new[] = $new_type + $new_status + $a;
                }
            }
            //上下页从操作
            $ppage = $page - 1;
            if ($ppage <= 1) {
                $ppage = 1;
            }
            $this->assign("ppage", $ppage);
            $npage = $page + 1;
            if ($npage >= $zy) {
                $npage = $zy;
            }
            $wid=34*$zy-$zy+1;
            $this->assign("wid",$wid);
	    if($zy>=5){
	        $wid2=34*5;
                $this->assign("wid2",$wid2);
	    }else{
	        $wid2=34*$zy;
                $this->assign("wid2",$wid2);
	    }
            

            $this->assign("page", $page);
            $this->assign("zy", $zy);
            $this->assign("prev", '<a tabindex="0" data-dt-idx="0" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&page=' . $ppage . '">上一页</a>');
            $this->assign("next", '<a tabindex="0" data-dt-idx="7" aria-controls="example2" href="admin.php?m=Admin&c=finance&a=index&page=' . $npage . '">下一页</a>');
    
            //清除session
            session("finance_search_time",null);
            session("finance_search_name",null);
            session("finance_search_level_id",null);
            session("finance_search_type",null);
            $this->assign("user", $new);
            //页面标题
            $this->assign("page_title", "财务管理");
            //渲染模板
            $this->display();

        }

    }

    /**
     * 异步拉取弹出框
     */
    public function tankuang()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $tf_finance = M('money_details');
        $tf_level = M('level');
        $tf_user = M('user');
        $data_money_details = $tf_finance->where("id=%d", array($id))->select();
        $data_level = $tf_level->select();
        $data_user = $tf_user->select();
        $new = array();
        foreach ($data_money_details as $a) {
            $n_type = $a['do_type'];
            $type = C(BUSINESS_TYPE);
            foreach ($type as $key => $ty) {
                if ($n_type == $key) {
                    $n_type = $ty;
                }
            }
            $new_type = array('do_type' => $n_type);
            $n_status = $a['status'];
            if ($n_status == 'reject') {
                $n_status = '拒绝';
            }
            if ($n_status == 'checked') {
                $n_status = '已审核';
            }
            if ($n_status == 'pending') {
                $n_status = '待审核';
            }
            if ($n_status == 'revoke') {
                $n_status = '撤销';
            }
            $new_status = array('status' => $n_status);
            $user_id = $a['user_id'];
            foreach ($data_user as $v) {
                $level_id = $v['level_id'];
                $user_name = array("user_name" => $v['name']);
                if ($user_id == $v['id']) {
                    $no1 = 'ok';
                    foreach ($data_level as $l) {
                        if ($level_id == $l['id']) {
                            $no2 = 'ok';
                            $ll = array("level_name" => $l['name']);
                            $new[] = $new_type + $new_status + $a + $v + $ll + $user_name;
                        }
                    }
                    if ($no2 == 'ok') {
                        $no2 = 'no';
                    } else {
                        $new[] = $new_type + $new_status + $a + $v + $user_name;
                    }
                }
            }
            if ($no1 == 'ok') {
                $no1 = 'no';
            } else {
                $new[] = $new_type + $new_status + $a;
            }
        }
        $this->assign("user", $new);
        echo json_encode($new);
    }

    /*
     * 审核
     */
    public function shenhe()
    {
        $id = isset($_GET['auditid']) ? $_GET['auditid'] : '';
        if (!$id) {
            exit;
        }
        //审核的状态
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        if (!$status) {
            exit;
        }
        if ($status == '拒绝') {
            $status = 'reject';
        }
        if ($status == '已审核') {
            $status = 'checked';
        }
        if ($status == '撤销') {
            $status = 'revoke';
        }
        //审核拒绝或撤销的内容
        $reason = isset($_GET['yuanyin']) ? $_GET['yuanyin'] : '';
        //操作数据
        $money = M('money_details');
        $user = M("user");
        //查询审核的数据
        $before = $money->where("id=$id")->find();
        $money_type = $before['do_type']; //获取资金类型
        $user_id = $before['user_id'];//获取用户id
        $user_money = $before['money'];//获取金额
        $user_integray = $before['integray'];//获取积分
        $before_status = $before['status'];  //之前的状态
        //之前是已通过现在是拒绝
        if ($before_status == "checked" & $status == 'reject') {
            die();
        }
        //之前是撤销
        if ($before_status == "revoke") {
            die();
        }
        //之前是拒绝现在是撤销
        if ($before_status == "reject" & $status == "revoke") {
            die();
        }
        if ($status == 'checked') {
            $reason = '';
        }
        //现在是待审核
        if ($status == 'pending') {
            exit();
        }
        //更新数据
        $money->status = $status;
        $rs = $money->where("id=$id")->save();
        if ($rs) {
            echo json_encode("成功");
            //获取用户数据
            $user_data = $user->where("id = $user_id")->find();
            if ($status == "checked" & $before_status != "checked") {
                if ($money_type == "cash") {
                    //提现
                    $balance = $user_data['money'];//获取之前的余额
                    $balance = $balance - $user_money;//提现后的金额
                    $user->money = $balance;
                    $money->real_money = $balance * 0.9;
                    $money->where("id=$id")->save();
                    $user->where("id=$user_id")->save();
                } else {
                    //年薪分红组团积分奖励
                    $balance = $user_data['money'];//获取之前的余额
                    $balance = $balance + $user_money;//奖励后的金额
                    $integray = $user_data['integray'];//获取之前的积分
                    $integray = $integray + $user_integray;//奖励之后的积分
                    $user->money = $balance;
                    $user->integral = $integray;
                    $user->where("id = $user_id")->save();
                }
            } else if ($status == "reject") {
                //审核拒绝
                $money->remark = $reason;
                $money->where("id=$id")->save();
            } else if ($status == "revoke") {
                //撤销
                $money->remark = $reason;
                $money->where("id=$id")->save();
                //给用户发消息
                $notices = M("notices");
                $message = array(
                    'userid' => $user_id,
                    'message' => $reason,
                    'type' => 'one',
                    'view' => 0,
                    'add_time' => date("Y-m-d H:i:s", time())
                );
                $notices->add($message);
            }
        }
    }

    /**
     * 导入EXCEL
     */
    public function excel() {
        $search_time = session("finance_search_time");
        $search_level_id = session("finance_search_level_id");
        $search_user_type = session("finance_search_type");
        $search_name = session("finance_search_name");
        //header 格式
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=财务明细.xls");
        // 列标题
        $user = iconv("UTF-8", "gb2312","用户名");
        $level = iconv("UTF-8", "gb2312","等级");
        $money = iconv("UTF-8", "gb2312","金额");
        $type = iconv("UTF-8", "gb2312","业务类型");
        $time = iconv("UTF-8", "gb2312","时间");
        $status = iconv("UTF-8", "gb2312","状态");
        echo   $user."\t";
        echo   $level."\t";
        echo   $money."\t";
        echo   $type."\t";
        echo   $time."\t";
        echo   $status."\t";
        echo   "\n";
        // 表格主体
        if(empty($search_name) & empty($search_time) & empty($search_level_id) & empty($search_user_type)){
            $data = M()->table("tf_money_details as money")->join("left join tf_user as user on money.user_id = user.id")->join("left join tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->order("money.add_time desc")->select();
        }else{
            if(!empty($search_time) & empty($search_level_id) & empty($search_user_type)){
                $where['money.add_time'] = array('eq',$search_time);
                $where['user.name'] = array('like',"%$search_name%");
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(empty($search_time) & !empty($search_level_id) & empty($search_user_type)){
                $where['level.id'] = array('eq',$search_level_id);
                $where['user.name'] = array('like',"%$search_name%");
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(empty($search_time) & empty($search_level_id) & !empty($search_user_type)){
                $where['user.user_type'] = array('eq',$search_user_type);
                $where['user.name'] = array('like',"%$search_name%");
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(!empty($search_time) & !empty($search_level_id) & empty($search_user_type)){
                $where['user.name'] = array('like',"%$search_name%");
                $where['money.add_time'] = array('eq',$search_time);
                $where['level.id'] = array('eq',$search_level_id);
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(!empty($search_time) & empty($search_level_id) & !empty($search_user_type)){
                $where['user.name'] = array('like',"%$search_name%");
                $where['money.add_time'] = array('eq',$search_time);
                $where['user.user_type'] = array('eq',$search_user_type);
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(empty($search_time) & !empty($search_level_id) & !empty($search_user_type)){
                $where['user.name'] = array('like',"%$search_name%");
                $where['user.user_type'] = array('eq',$search_user_type);
                $where['level.id'] = array('eq',$search_level_id);
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(!empty($search_time) & !empty($search_level_id) & !empty($search_user_type)){
                $where['user.name'] = array('like',"%$search_name%");
                $where['user.user_type'] = array('eq',$search_user_type);
                $where['level.id'] = array('eq',$search_level_id);
                $where['money.add_time'] = array('eq',$search_time);
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }else if(empty($search_time) & empty($search_level_id) & empty($search_user_type)){
                $where['user.name'] = array('like',"%$search_name%");
                $data = M()->table("tf_money_details as money")->join("tf_user as user on money.user_id = user.id")->join("tf_level as level on user.level_id = level.id")->field("user.name as user_name,level.name as level_name,money.money,money.do_type,money.add_time,money.status")->where($where)->order("money.add_time desc")->select();
            }


        }

        foreach ($data as $key=>$value){
            //业务类型
            $award_type = null;
            if($value['do_type'] == 'cash'){
                $award_type = '提现';
            }else if($value['do_type'] == "award_integral"){
                $award_type = '积分奖励';
            }else if($value['do_type'] == "award_team"){
                $award_type = "团队奖励";
            }else if($value['do_type'] == "award_bonus"){
                $award_type = "分红奖励";
            }else if($value['do_type'] == "award_referee"){
                $award_type = "推荐奖励";
            }else if($value['do_type'] == "award_fans"){
                $award_type = "粉丝奖励";
            }else if($value['do_type'] == "year_salary"){
                $award_type = "年薪奖励";
            }else if($value['do_type'] == "other"){
                $award_type = "其他";
            }

            //状态
            $status = null;
            if($value['status'] == "pending"){
                $status ="待审核";
            }else if($value['status'] == "checked"){
                $status = "审核通过";
            }else if($value['status'] == "revoke"){
                $status = "撤销";
            }else if($value['status'] == "reject"){
                $status = '拒绝';
            }

            echo iconv("UTF-8", "gb2312",$value['user_name'])."\t";
            echo iconv("UTF-8", "gb2312",$value['level_name'])."\t";
            echo $value['money']."\t";
            echo iconv("UTF-8", "gb2312",$award_type)."\t";
            echo $value['add_time']."\t";
            echo iconv("UTF-8", "gb2312",$status)."\t";
            echo  "\n";
        }

    }
}