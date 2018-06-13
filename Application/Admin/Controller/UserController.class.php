<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Model;
use Think\Think;

/**
 * 控制器基类
 * Created by PhpStorm.
 * User: CJF
 * Date: 2016/11/10
 * Time: 21:50
 * Description: 描述
 */
class UserController extends BaseController{
    /**
     * 显示用户页面
     */
    public function type($type) {
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        //页面标题
        $this->assign("page_title", "用户管理");
        //筛选数据
        $obj = M('user');
        $user_type_sql = "select count(user_type) as user_type_num from tf_user WHERE `user_type`='$type'";
        $count = $obj->query($user_type_sql);//查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count[0]['user_type_num'],$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $data =M()->order('add_time desc')->table("tf_user as user")->join("LEFT JOIN tf_level as level ON user.level_id = level.id")->where("user_type='$type'")->field("user.id,user.add_time,user.name,user.real_name,user.tel,user.user_type,user.money,user.integral,user.is_validated,level.name as level_name")->page($p,$page_size)->select();//数据集
        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //获取待审核
        $sql = "select count(is_validated) as num from tf_user where `user_type`='$type' AND is_validated = 'pending'";
        $rs = $obj->query($sql);
        $this->assign("no_num",$rs[0]['num']);
        //获取等级
        $level = M('level');
        $level_data = $level->field('id,name')->select();
        $this->assign("level_data",$level_data);
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        $this->assign("type",$type);
        //渲染模板
        $this->display('user');
    }

    /**
     *  对用户的个人操作
     */
    public function operation($type) {
        if(trim($_GET['operation']) == "look_team"){
                //查看团队
                $this->user_team($type);
            }else if(trim($_GET['operation']) == "look_fans"){
                //查看粉丝
                $this->user_fans($type);
            }else if(trim($_GET['operation']) == "look_capital"){
                //资金明细
                $this->user_capital($type);
            }else if (trim($_GET['operation']) == "edit"){
                //编辑
                $this->user_edit($type);
            }else if (trim($_GET['operation']) == "add_user"){
                //添加用户
                $this->user_add($type);
            }else if(trim($_GET['operation']) == "user_search"){
                //用户搜索
                $this->user_search($type);
            }else if(trim($_GET['operation']) == "user_capital_search"){
                //资金过滤
                $this->capital_filter($type);
        }
    }

    //清除对用户搜索的session(不包含粉丝)
    public function clear_user_session() {
        session("user_user_search_province_id",null);
        session("user_user_search_city_id",null);
        session("user_user_search_district_id",null);
        session("user_user_search_level",null);
        session("user_user_search",null);
    }

    /**
     *省代理
     */
    public function province_agent()
    {
        $type = "province_agent";
        if (isset($_GET['operation'])) {
            //对用户的操作
            $this->operation($type);
        } else {
            //清除session
            $this->clear_user_session();
            //加载用户列表
            $this->type($type);
        }
    }

    /**
     * 市代理
     */
    public function city_agent() {
        $type = "city_agent";
        if (isset($_GET['operation'])) {
            //对用户的操作
            $this->operation($type);
        } else {
            //清除session
            $this->clear_user_session();
            //加载用户列表
            $this->type($type);
        }
    }

    /**
     * 区代理
     */
    public function district_agent(){
        $type = "district_agent";
        if (isset($_GET['operation'])) {
            //对用户的操作
            $this->operation($type);
        } else {
            //清除session
            $this->clear_user_session();
            //加载用户列表
            $this->type($type);
        }
    }

    /**
     * 合作商家
     */
   /* public function partner(){

        $type = "partner";
        if (isset($_GET['operation'])) {
            //对用户的操作
            $this->operation($type);
        } else {
            //清除session
            $this->clear_user_session();
            //加载用户列表
            $this->type($type);
        }
    }*/

    /**
     * T会员
     */
    public function member(){
        $type = "member";
        if (isset($_GET['operation'])) {
            //对用户的操作
            $this->operation($type);
        } else {
            //清除session
            $this->clear_user_session();
            //加载用户列表
            $this->type($type);
        }
    }

    /**
     * 粉丝
     */
    public function fan(){

        if(trim($_GET['operation']) == "fans_search"){
            $this->fans_search();
        }else{
            session("user_fans_search_province_id",null);
            session("user_fans_search_city_id",null);
            session("user_fans_search_district_id",null);
            session("user_fans_search",null);
            $p = trim(isset($_GET['p'])?$_GET['p']:"1");
            $page_size = C('PAGE_SIZE');
            //页面标题
            $this->assign("page_title", "粉丝管理");
            //筛选数据
            $obj = M('user');
            $user_type_sql = "select count(id) as user_type_num from tf_user WHERE `user_type`='fan'";
            $count = $obj->query($user_type_sql);//查询满足要求的总记录数
            $Page = new \Common\Util\MyPage($count[0]['user_type_num'],$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
            $show = $Page->show();// 分页显示输出
            $data =M()->order('add_time desc')->table("tf_user as user_fan")->join("LEFT JOIN tf_user as user ON user_fan.parentid = user.id")->where("user_fan.user_type='fan'")->field("user_fan.id,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_fan.user_type,user_fan.is_validated,user.name as user_name")->page($p,$page_size)->select();//数据集
            $this->assign('data',$data);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            //获取待审核
            $sql = "select count(is_validated) as num from tf_user where `user_type`='fan' AND is_validated = 'pending'";
            $rs = $obj->query($sql);
            $this->assign("no_num",$rs[0]['num']);
            //标识页面
            $this->assign("type",'fan');
            //渲染模板
            $this->display('fans');
        }
    }

    /**
     *用户添加
     */
    public function user_add($type){
        //页面标题
        $this->assign("page_title", "添加用户");
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        //获取等级
        $level = M('level');
        $level_data = $level->field('id,name')->select();
        $this->assign("level_data",$level_data);
        //标识页面
        $this->assign("type",$type);
        //渲染模板
        $this->display('user_add');
    }

    /**
     * 团队页面
     */
    public function user_team($type) {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        //页面标题
        $this->assign("page_title", "团队列表");
        //筛选数据
        $obj = M('team');
        $count = $obj->where("owner=$id")->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $data =M()->table("tf_team as team")->join("tf_user as user ON user.id = team.owner and user.id = $id")->field("team.id,user.real_name,team.add_time,team.members_names,team.num,team.status,team.members_ids")->page($p,$page_size)->select();//数据集
        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        //渲染模板
        $this->display('user_team');
    }

    /**
     * 查看粉丝
     */
    public function user_fans($type){
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        //页面标题
        $this->assign("page_title", "粉丝列表");
        //筛选数据
        $obj = M('user');
        $sql = "select count(id) as num from tf_user WHERE user_type = 'fan' AND parentid=$id";
        $count = $obj->query($sql);//查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count[0]['num'],$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $data =$obj->order('add_time desc')->where("user_type='fan' and parentid=$id")->page($p,$page_size)->select();//数据集
        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        //获取待审核
        $data_pending = $obj->where("user_type = 'fan' and parentid=$id and is_validated = 'pending'")->select();
        $no_num = count($data_pending);
        $this->assign("no_num",$no_num);
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        $this->assign("type",$type);
        //渲染模板
        $this->display('user_fans');
    }

    /**
     * 资金明细页面
     */
    public function user_capital($type) {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        //获取每页的显示数量
        $page_size = C('PAGE_SIZE');
        //获取奖励的类型
        $reward_type = C('BUSINESS_TYPE');
        $this->assign('reward_type',$reward_type);
        //页面标题
        $this->assign("page_title", "资金明细");
        //筛选数据
        $obj = M('money_details');
        $count = $obj->where("user_id=$id")->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(5)
        $show = $Page->show();// 分页显示输出
        $data =$obj->order('add_time desc')->where("user_id=$id")->page($p,$page_size)->select();//数据集
        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign("id",$id);
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        $this->assign("type",$type);
        //渲染模板
        $this->display('user_capital');
    }

    /**
     * 编辑页面
     */
    public function user_edit($type) {
        //页面标题
        $this->assign("page_title", "编辑");
        //筛选数据
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $obj = M("user");
        $data = $obj->where("id=$id")->find();
        $this->assign("data",$data);
        //获取等级
        $level = M('level');
        $level_data = $level->field('id,name')->select();
        $this->assign("level_data",$level_data);
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        //渲染模板
        $this->display('user_edit');
    }

    /**
     *查看详情
     */
    public function view_details() {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        //拥有团队数量
        $obj = M('team');
        $sql = "select count(owner) as team_sum from tf_team WHERE owner = $id";
        $team_sum = $obj->query($sql);
        echo $team_sum['0']['team_sum'];
        //筛选数据
        $obj = M('user');
        $data = $obj->where("id=$id")->select();
        echo json_encode($data);
    }

    /**
     * 粉丝查看详情
     */
    public function fans_details(){

        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $data =M()->table("tf_user as user_fan")->join("tf_user as user ON user_fan.parentid = user.id")->where("user_fan.id=$id")->field("user_fan.id,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_fan.user_type,user_fan.age,user_fan.sex,user_fan.address,user_fan.identity,user_fan.is_validated,user.name as user_name")->select();//数据集
        echo json_encode($data);
    }

    /**
     * 粉丝页面搜索
     */
    public function fans_search(){
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        $begin = ($p-1)*$page_size;
        //省id
        $province_id = trim(!empty($_POST['province_id'])?$_POST['province_id']:"");
        if(!empty($province_id)){
            session("user_fans_search_province_id",$province_id);
        }
        $province_id = empty($province_id)?session("user_fans_search_province_id"):$province_id;
        //市id
        $city_id = trim(!empty($_POST['city_id'])?$_POST['city_id']:"");
        if(!empty($city_id)){
            session("user_fans_search_city_id",$city_id);
        }
        $city_id = empty($city_id)?session("user_fans_search_city_id"):$city_id;
        //区id
        $district_id = trim(!empty($_POST['district_id'])?$_POST['district_id']:"");
        if(!empty($district_id)){
            session("user_fans_search_district_id",$district_id);
        }
        $district_id = empty($district_id)?session("user_fans_search_district_id"):$district_id;
        //搜索内容
        $search = trim(isset($_POST['search'])?$_POST['search']:"");
        if(!empty($search)){
            session("user_fans_search",$search);
        }
        $search = empty($search)?session("user_fans_search"):$search;
        //筛选数据
        $obj = M('user');
        $sql = null;
        $page_sql = null;
        if ($province_id=="" & $city_id=="" & $district_id=="" & $search=="") {
            $page_sql = "select user_fan.id,user_fan.is_validated,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' order by add_time desc limit $begin,$page_size";
            $sql = "select user_fan.id,user_fan.is_validated,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan'";
        } else {
            if ($province_id == "") {
                $page_sql = "select user_fan.id,user_fan.is_validated,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                $sql = "select user_fan.id,user_fan.is_validated,user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%')";
            } else {
                if ($city_id == "") {
                    $page_sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                    $sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%')";
                } else {
                    if ($district_id == "") {
                        $page_sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND user_fan.city_id = '$city_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND user_fan.city_id = '$city_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%')";
                    } else {
                        $page_sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND user_fan.city_id = '$city_id' AND user_fan.district_id = '$district_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select user_fan.id, user_fan.is_validated, user_fan.add_time,user_fan.name,user_fan.real_name,user_fan.tel,user_parent.name as user_name from tf_user as user_fan LEFT JOIN tf_user as user_parent ON user_fan.parentid = user_parent.id WHERE user_fan.user_type='fan' AND user_fan.province_id = '$province_id' AND user_fan.city_id = '$city_id' AND user_fan.district_id = '$district_id' AND ( user_fan.name LIKE '%$search%' OR user_fan.real_name LIKE '%$search%' OR user_fan.tel LIKE '%$search%' OR user_parent.name LIKE '%$search%')";
                    }

                }
            }
        }
        //获取搜索后的待审核数量
        $data_pending = $obj->query($sql);
        $i = "";
        foreach ($data_pending as $key => $val){
            if($val['is_validated'] == "pending"){
                $i++;
            }
        }
        if($i == ""){
            $i =0;
        }
        $this->assign("no_num",$i);
        //分页
        $count = count($data_pending);
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("page",$show);
        //搜索数据
        $data = $obj->query($page_sql);
        $this->assign("data",$data);
        //搜索内容返回
        $this->assign("province_id",$province_id);
        $this->assign("city_id",$city_id);
        $this->assign("district_id",$district_id);
        $this->assign("search",$search);
        //标识页面
        $this->assign("type",'fan');
        //页面标题
        $this->assign("page_title", "粉丝管理");
        //加载模板
        $this->display("fans");
    }

    /**
     * 删除
     */
    public function del() {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        if($id == ""){
            $this->error("缺少参数",U("user/index"));
            die();
        }

        //删除数据
        $obj = M('user');
        $rs = $obj->where("id=$id")->delete();
        if($rs){
            $this->success("删除成功");
        }else{
            $this->error("删除失败：数据不存在");
        }

    }

    /**
     * 审核
     */
    public function review() {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        $reason_msg = trim(isset($_GET['reason'])?$_GET['reason']:"");
        if($id == ""){
            $this->error("缺少参数");
        }
        $review = trim(isset($_GET['review'])?$_GET['review']:"");
        //修改数据
        $obj = M('user');
        $level = M('level');
        $money = M("money_details");
        $options = M("options");
        //查询之前的状态
        $before = $obj->where("id = $id")->field("is_validated,real_name")->find();
        if($before['is_validated'] == 'yes' & $review == 'no'){
           echo 'no';
            die();
        }
        //更改状态
        $obj->is_validated = $review;
        $rs = $obj->where("id=$id")->save();

        //审核成功后的操作
        if ($rs) {
            if($review == "no" & $before['is_validated'] != 'no'){
                //给用户发消息
                //被审核人的信息
                $row = $obj->where("id=$id")->find();
                //获取推荐人id
                $parentid = $row['parentid'];
                if (empty($parentid)) {
                    die();
                }
                $notices = M("notices");
                if($reason_msg == ""){
                    $reason_msg = "你推荐的会员".$row['real_name']."审核未通过";
                }else{
                    $reason_msg ="你推荐的会员".$row['real_name']."审核未通过原因:". $reason_msg;
                }
                $message = array(
                    'userid' => $parentid,
                    'message' => $reason_msg,
                    'type' => 'one',
                    'view' => 0,
                    'add_time' => date("Y-m-d H:i:s", time())
                );
                $notices->add($message);
            }
            if ($review == "yes" & $before['is_validated'] != "yes") {
                //被审核人的信息
                $row = $obj->where("id=$id")->find();
                //审核成功
                if ($row['user_type'] == 'fan') {
                    //审核的为粉丝
                    //获取推荐人id
                    $parentid = $row['parentid'];
                    if (empty($parentid)) {
                        die();
                    }
                    //获取推荐人等级
                    $user = $obj->where("id=$parentid")->field("level_id")->find();
                    $level_id = $user['level_id'];
                    $user_level_data = $level->where("id=$level_id")->find();
                    //查询当月粉丝总奖励
                    $sql = "select sum(money) AS money from tf_money_details where date_format(`add_time`, '%Y%m') = date_format(curdate(),'%Y%m') AND `do_type`='award_fans' AND user_id='$parentid' AND status='checked'";
                    $money_fans = $money->query($sql);
                    //每月粉丝奖励最大金额
                    $max_money_sql = "select `value` from tf_options WHERE `key`='month_fans_max_award'";
                    $max_money = $options->query($max_money_sql);
                    $max_money = $max_money[0]['value'];
                    if ($money_fans[0]['money'] < $max_money) {
                        //推荐粉丝奖励单个金额
                        $award_fans = $user_level_data['award_fans'];
                        //推荐粉丝奖励的积分
                        $award_integray = 200;
                        //每月奖励之后的总金额
                        $award_after = $money_fans[0]['money'] + $award_fans;
                        //判断是否超出最大金额
                        if ($award_after > $max_money) {
                            //超出最大奖励
                            $award_fans = $max_money - $money_fans[0]['money'];
                            //给推荐人奖励
                            //查询之前的金额
                            $before_balance = $obj->where("id=$parentid")->field("money")->find();
                            //现在的金额
                            $after_balance = $before_balance['money'] + $award_fans;
                            //查询之前的粉丝总数量
                            $before_fans = $obj->where("id=$parentid")->field("fans")->find();
                            //现在的粉丝总数量
                            $after_fans = $before_fans['fans'] + 1;
                            $obj->fans = $after_fans;
                            $obj->money = $after_balance;
                            $obj->where("id=$parentid")->save();
                            //添加数据到资金明细表
                            $data = array(
                                'user_id' => $parentid,
                                'money' => $award_fans,
                                'integray' => $award_integray,
                                'do_type' => 'award_fans',
                                'description' => "推荐粉丝" . $before['real_name'] . "的奖励,奖励不是300是由于超出最大金额",
                                'add_time' => date("Y-m-d H:i:s", time()),
                                'status' => 'checked',
                            );
                            $money->add($data);
                        } else {
                            //未超出最大奖励
                            //给推荐人奖励
                            $before_balance = $obj->where("id=$parentid")->field("money")->find();
                            $after_balance = $before_balance['money'] + $award_fans;
                            $obj->money = $after_balance;
                            $obj->where("id=$parentid")->save();
                            //添加数据到资金明细表
                            $data = array(
                                'user_id' => $parentid,
                                'money' => $award_fans,
                                'integray' => $award_integray,
                                'do_type' => 'award_fans',
                                'description' => "推荐粉丝" . $before['real_name'] . "的奖励",
                                'add_time' => date("Y-m-d H:i:s", time()),
                                'status' => 'checked',
                            );
                            $money->add($data);
                        }
                    }
                } else if ($row['user_type'] == 'member') {
                    //审核的是会员
                    //获取被审核人所在的省市区代理;
                    $province_id = $row['province_id'];//被审核人省id
                    $city_id = $row['city_id'];//被审核人市id
                    $district_id = $row['district_id'];//被审核人区id
                    //省代理数据
                    $province_data = $obj->where("user_type='province_agent' and province_id=$province_id and is_validated='yes' and status='enabled'")->find();
                    if (!empty($province_data)) {
                        //省代理id
                        $province_agent = $province_data['id'];
                        //增加金额
                        $before_balance = $obj->where("id=$province_agent")->field("money")->find();
                        $after_balance = $before_balance['money'] + 600;
                        $obj->money = $after_balance;
                        $obj->where("id=$province_agent")->save();
                        //添加数据到资金明细表
                        //添加数据到资金明细表
                        $data = array(
                            'user_id' => $province_agent,
                            'money' => 600,
                            'do_type' => 'award_member',
                            'description' => "新会员" . $before['real_name'] . "注册成功的奖励",
                            'add_time' => date("Y-m-d H:i:s", time()),
                            'status' => 'checked',
                        );
                        $money->add($data);
                    }
                    //市代理数据
                    $city_data = $obj->where("user_type='city_agent' and city_id=$city_id and is_validated='yes' and status='enabled'")->find();
                    if (!empty($city_data)) {
                        //市代理id
                        $city_agent = $city_data['id'];
                        //增加金额
                        $before_balance = $obj->where("id=$city_agent")->field("money")->find();
                        $after_balance = $before_balance['money'] + 600;
                        $obj->money = $after_balance;
                        $obj->where("id=$city_agent")->save();
                        //添加数据到资金明细表
                        //添加数据到资金明细表
                        $data = array(
                            'user_id' => $city_agent,
                            'money' => 600,
                            'do_type' => 'award_member',
                            'description' => "新会员" . $before['real_name'] . "注册成功的奖励",
                            'add_time' => date("Y-m-d H:i:s", time()),
                            'status' => 'checked',
                        );
                        $money->add($data);
                    }
                    //区代理数据
                    $district_data = $obj->where("user_type='district_agent' and district_id=$district_id and is_validated='yes' and status='enabled'")->find();
                    if (!empty($district_data)) {
                        //省代理id
                        $district_agent = $district_data['id'];
                        //增加金额
                        $before_balance = $obj->where("id=$district_agent")->field("money")->find();
                        $after_balance = $before_balance['money'] + 600;
                        $obj->money = $after_balance;
                        $obj->where("id=$district_agent")->save();
                        //添加数据到资金明细表
                        //添加数据到资金明细表
                        $data = array(
                            'user_id' => $district_agent,
                            'money' => 600,
                            'do_type' => 'award_member',
                            'description' => "新会员" . $before['real_name'] . "注册成功的奖励",
                            'add_time' => date("Y-m-d H:i:s", time()),
                            'status' => 'checked',
                        );
                        $money->add($data);
                    }
                    //获取推荐人id
                    $parentid = $row['parentid'];
                    if (empty($parentid)) {
                        die();
                    }
                    //获取推荐人等级
                    $user = $obj->where("id=$parentid")->field("level_id")->find();
                    $level_id = $user['level_id'];
                    $user_level_data = $level->where("id=$level_id")->find();
                    //查询当月推荐总奖励
                    $sql = "select sum(money) AS money from tf_money_details where date_format(`add_time`, '%Y%m') = date_format(curdate(),'%Y%m') AND `do_type`='award_referee' AND user_id='$parentid' AND status='checked'";
                    $money_user = $money->query($sql);
                    //查询每月最大奖励金额
                    $max_money_sql = "select `value` from tf_options WHERE `key`='month_direct_max_award'";
                    $max_money = $options->query($max_money_sql);
                    $max_money = $max_money[0]['value'];
                    if ($money_user[0]['money'] < $max_money) {
                        //获取推荐会员的单个金额
                        $award_referee = $user_level_data['award_direct'];
                        //每月奖励之后的总金额
                        $award_after = $money_user[0]['money'] + $award_referee;
                        //判断是否超出最大金额
                        if ($award_after > $max_money) {
                            //超出最大奖励
                            $award_referee = $max_money - $money_user[0]['money'];
                            //给推荐人奖励
                            $before_balance = $obj->where("id=$parentid")->field("money")->find();
                            $after_balance = $before_balance['money'] + $award_referee;
                            $obj->money = $after_balance;
                            $obj->where("id=$parentid")->save();
                            //添加数据到资金明细表
                            $data = array(
                                'user_id' => $parentid,
                                'money' => $award_referee,
                                'do_type' => 'award_referee',
                                'description' => "推荐" . $before['real_name'] . "的奖励,奖励不是2000是由于超出最大金额",
                                'add_time' => date("Y-m-d H:i:s", time()),
                                'status' => 'checked',
                            );
                            $money->add($data);
                        } else {
                            //未超出最大奖励
                            //给推荐人奖励
                            $before_balance = $obj->where("id=$parentid")->field("money")->find();
                            $after_balance = $before_balance['money'] + $award_referee;
                            $obj->money = $after_balance;
                            $obj->where("id=$parentid")->save();
                            //添加数据到资金明细表
                            $data = array(
                                'user_id' => $parentid,
                                'money' => $award_referee,
                                'do_type' => 'award_referee',
                                'description' => "推荐" . $before['real_name'] . "的奖励",
                                'add_time' => date("Y-m-d H:i:s", time()),
                                'status' => 'checked',
                            );
                            $money->add($data);
                        }
                    }
                }
            }
        }
    }

    /**
     * 解散团队
     */
    public function disband_team() {
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        if($id == ""){
            $this->error("缺少参数");
            die();
        }

        //删除数据
        $obj = M('team');
        $rs = $obj->where("id=$id")->delete();
        if($rs){
            $this->success("删除成功");
        }else{
            $this->error("删除失败");
        }
    }

    /**
     *添加粉丝位
     */
    public function addfans() {
        $id = trim(isset($_POST['id'])?$_POST['id']:"");
        if($id == ""){
            $this->error("缺少参数");
        }
        $fans = trim(isset($_POST['fans'])?$_POST['fans']:"");
        $fans = floor($fans);
        $add_year = trim(isset($_POST['add_year'])?$_POST['add_year']:"");
        $add_year = floor($add_year);
        if($fans == "" & $add_year == ""){
            $this->error("缺少参数");
        }else{
            $obj = M('user');
            if($add_year == ""){
                //添加粉丝位
                $data = $obj->where("id=$id")->field("month_fans")->select();
                $num = $data[0]['month_fans'];
                $obj->month_fans = $fans+$num;
                $rs = $obj->where("id=$id")->save();
                if($rs){
                    $this->success("添加粉丝位成功");
                }else{
                    $this->error("添加粉丝位失败");
                }
            }else if($fans == ""){
                //延长年限
                $sql = "UPDATE tf_user SET add_time = DATE_ADD(add_time,INTERVAL $add_year YEAR) WHERE id=$id";
                $rs = $obj->execute($sql);
                if($rs){
                    $this->success("延长年限成功");
                }else{
                    $this->error("延长年限失败");
                }
            }else{
                //既添加粉丝位又延长年限
                //添加粉丝位
                $data = $obj->where("id=$id")->field("month_fans")->select();
                $num = $data[0]['month_fans'];
                $obj->month_fans = $fans+$num;
                $rs1 = $obj->where("id=$id")->save();
                //延长年限
                $sql = "UPDATE tf_user SET add_time = DATE_ADD(add_time,INTERVAL $add_year YEAR) WHERE id=$id";
                $rs2 = $obj->execute($sql);
                if($rs1 & $rs2){
                    $this->success("添加成功");
                }else{
                    if($rs1){
                        $this->success("添加粉丝位成功，延长年限失败");
                    }else if($rs2){
                        $this->success("延长年限成功,添加粉丝位失败");
                    }else{
                        $this->error("添加粉丝位失败，延长年限失败");
                    }
                }
            }
        }
    }

    /**
     * 搜索
     */
    public function user_search($user_type) {
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        $begin = ($p-1)*$page_size;
        //省id
        $province_id = trim(!empty($_POST['province_id'])?$_POST['province_id']:"");
        if(!empty($province_id)){
            session("user_user_search_province_id",$province_id);
        }
        $province_id = empty($province_id)?session("user_user_search_province_id"):$province_id;
        //市id
        $city_id = trim(!empty($_POST['city_id'])?$_POST['city_id']:"");
        if(!empty($city_id)){
            session("user_user_search_city_id",$city_id);
        }
        $city_id = empty($city_id)?session("user_user_search_city_id"):$city_id;
        //区id
        $district_id = trim(!empty($_POST['district_id'])?$_POST['district_id']:"");
        if(!empty($district_id)){
            session("user_user_search_district_id",$district_id);
        }
        $district_id = empty($district_id)?session("user_user_search_district_id"):$district_id;
        //等级
        $level = trim(!empty($_POST['level'])?$_POST['level']:"");
        if(!empty($level)){
            session("user_user_search_level",$level);
        }
        $level = empty($level_data)?session("user_user_search_level"):$level;
        //搜索的内容
        $search = trim(isset($_POST['search'])?$_POST['search']:"");
        if(!empty($search)){
            session("user_user_search",$search);
        }
        $search = empty($search)?session("user_user_search"):$search;
        //搜索数据
        $page_sql = null;
        $sql = null;
        $obj = M("user");
        if($province_id == ""){
            if($level == ""){
                $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
            }else{
                $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`= '$user_type' AND tf_level.id=$level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`= '$user_type' AND tf_level.id=$level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
            }

        }else {
            if($city_id == ""){
                if ($level == ""){
                    $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                    $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                }else{
                    $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND tf_level.id = $level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                    $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND tf_level.id = $level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                }

            }else{
                if($district_id == ""){
                    if($level == ""){
                        $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `city_id` = $city_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `city_id` = $city_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                    }else{
                        $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `city_id` = $city_id AND tf_level.id = $level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `city_id` = $city_id AND tf_level.id = $level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                    }

                }else{
                    if($level == ""){
                        $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `district_id` = $district_id AND `city_id` = $city_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `district_id` = $district_id AND `city_id` = $city_id AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                    }else{
                        $page_sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `district_id` = $district_id AND `city_id` = $city_id AND tf_level.id=$level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%') order by add_time desc limit $begin,$page_size";
                        $sql = "select tf_user.id,tf_user.name,tf_level.name as level_name,real_name,money,add_time,is_validated,tel,user_type,integral from tf_user LEFT JOIN tf_level ON tf_user.level_id=tf_level.id WHERE `user_type`='$user_type' AND `province_id` = $province_id AND `district_id` = $district_id AND `city_id` = $city_id AND tf_level.id=$level AND (tf_user.name LIKE '%$search%' OR `real_name` LIKE '%$search%' OR `tel` LIKE '%$search%' OR `money` LIKE '%$search%' OR `integral` LIKE '%$search%')";
                    }
                }
            }
        }
        //获取待审核数
        $data_pending = $obj->query($sql);
        $i = "";
        foreach ($data_pending as $key => $val){
            if($val['is_validated'] == "pending"){
                $i++;
            }
        }
        if($i == ""){
            $i =0;
        }
        $this->assign("no_num",$i);
        //分页
        $count = count($data_pending);
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("page",$show);
        //搜索数据
        $data = $obj->query($page_sql);
        $this->assign("data",$data);
        //搜索内容返回
        $this->assign("province_id",$province_id);
        $this->assign("city_id",$city_id);
        $this->assign("district_id",$district_id);
        $this->assign("level",$level);
        $this->assign("search",$search);
        //页面标题
        $this->assign("page_title", "用户管理");
        //获取等级
        $level = M('level');
        $level_data = $level->field('id,name')->select();
        $this->assign("level_data",$level_data);
        //标识页面
        $user_type_url = U("user/$user_type");
        $this->assign("user_type_url", $user_type_url);
        $this->assign("type",$user_type);
        //渲染模板
        $this->display('user');
    }

    //升级为会员
    public function upgrade(){
        $id = trim(isset($_GET['id'])?$_GET['id']:"");
        if($id == ""){
            $this->error("缺少参数",U("user/index"));
            die();
        }
        //变为会员
        $obj = M("user");
        $data = $obj->where("id = $id")->field("user_type")->find();
        if($data['user_type'] == "fan"){
            $obj->user_type = 'member';
            $obj->level_id = 1;
            $obj->add_time = date("Y-m-d H:i:s",time());
            $rs = $obj->where("id = $id")->save();
            if($rs){
                $msg = array(
                    'userid'=>$id,
                    'message'=>"升级为T会员成功",
                    'view'=>0,
                    'type'=>'one',
                    'add_time'=>date("Y-m-d H:i:s",time())
                );
                M()->table("tf_notices")->add($msg);
                $this->success("升级为会员成功",U('user/member'));
            }else{
                $this->error("升级为会员失败");
            }
        }else{
            $this->error("无效的操作");
        }

    }

    /**
     * 编辑表单
     */
    public function user_edit_form() {
        $id = trim(isset($_POST['id'])?$_POST['id']:"");
        if($id == ""){
            $this->error("缺少参数");
            die();
        }
        $real_name =trim(isset($_POST['real_name'])?$_POST['real_name']:"");
        $tel =trim(isset($_POST['tel'])?$_POST['tel']:"");
        $age =trim(isset($_POST['age'])?$_POST['age']:"");
        $sex =trim(isset($_POST['sex'])?$_POST['sex']:"");
        $province_id =trim(isset($_POST['province_id'])?$_POST['province_id']:"");
        $city_id =trim(isset($_POST['city_id'])?$_POST['city_id']:"");
        $district_id =trim(isset($_POST['district_id'])?$_POST['district_id']:"");
        $address =trim(isset($_POST['address'])?$_POST['address']:"");
        $identity =trim(isset($_POST['identity'])?$_POST['identity']:"");
        $is_validated =trim(isset($_POST['is_validated'])?$_POST['is_validated']:"");
        $identity_img =trim(isset($_POST['identity_img'])?$_POST['identity_img']:"");
        $money =trim(isset($_POST['money'])?$_POST['money']:"");
        $integral =trim(isset($_POST['integral'])?$_POST['integral']:"");
        $user_type =trim(isset($_POST['user_type'])?$_POST['user_type']:"");
        $level_id =trim(isset($_POST['level'])?$_POST['level']:"");
        $status =trim(isset($_POST['status'])?$_POST['status']:"");
        $data = array(
            'real_name'=>$real_name,
            'tel'=>$tel,
            'age'=>$age,
            'sex'=>$sex,
            'province_id'=>$province_id,
            'city_id'=>$city_id,
            'district_id'=>$district_id,
            'address'=>$address,
            'identity'=>$identity,
            'is_validated'=>$is_validated,
            'identity_img'=>$identity_img,
            'money'=>$money,
            'integral'=>$integral,
            'user_type'=>$user_type,
            'level_id'=>$level_id,
            'status'=>$status

        );
        //更新数据
        $obj = M('user');
        //判断是数据是否和原来一样
        $a = 0;
        $data_before = $obj->where("id=$id")->find();
        foreach ($data as $key => $value){
            foreach ($data_before as $key2 => $value2){
                if($key == $key2){
                    if($value != $value2){
                        $a++;
                    }
                }
            }
        }
        if($a == 0){
            $this->success("修改成功");
            die();
        }
        //判断省市区代理
        if($data_before['user_type'] != $user_type or $data_before['province_id'] != $province_id or $data_before['city_id'] != $city_id or $data_before['district_id'] != $district_id){
            if($user_type == 'province_agent'){
                $data_province = $obj->where("user_type='$user_type' and province_id=$province_id")->select();
                $province_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
                if (count($data_province)!= 0){
                    $this->error($province_name['region_name']."代理已存在,请重新修改。");
                    die();
                };
            }else if($user_type == 'city_agent'){
                $data_city = $obj->where("user_type='$user_type' and city_id=$city_id")->select();
                $city_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
                if (count($data_city)!= 0){
                    $this->error($city_name['region_name']."代理已存在,请重新修改。");
                    die();
                };
            }else if($user_type == 'district_agent'){
                $data_district = $obj->where("user_type='$user_type' and district_id=$district_id")->select();
                $district_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
                if (count($data_district)!= 0){
                    $this->error($district_name['region_name']."代理已存在,请重新修改。");
                    die();
                };
            }
        }
        //判断身份证号码
        $data_identity = $obj->where("identity = '$identity'")->select();
        if (count($data_identity)!= 0){
            if($data_before['identity'] != $identity){
                $this->error("该身份证号码已被注册");
                die();
            }
        };
        //判断电话号码
        $data_tel = $obj->where("tel = '$tel'")->select();
        if (count($data_tel)!= 0){
            if($data_before['tel'] != $tel){
                $this->error("该手机号码已注册");
                die();
            }
        };
        $rs = $obj->where("id=$id")->save($data);
        if($rs){
            $this->success("修改成功");
        }else{
            $this->error("修改失败");
        }

    }

    /**
     * 资金过滤
     */
    public function capital_filter($type){
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");
        $page_size = C('PAGE_SIZE');
        //id
        $id =trim(isset($_POST['id'])?$_POST['id']:"");
        if(!empty($id)){
            session("user_capital_filter_id",$id);
        }
        $id = empty($id)?session("user_capital_filter_id"):$id;
        //时间
        $time =trim(isset($_POST['time'])?$_POST['time']:"");
        if(!empty($time)){
            session("user_capital_filter_time",$time);
        }
        $time = empty($time)?session("user_capital_filter_time"):$time;
        //奖励类型
        $reward =trim(isset($_POST['reward'])?$_POST['reward']:"");
        if(!empty($reward)){
            session("user_capital_filter_reward",$reward);
        }
        $reward = empty($reward_type)?session("user_capital_filter_reward"):$reward;
        //筛选数据
        $obj = M('money_details');
        $data = null;
        if($time == ""){
            if($reward == ""){
                $data = $obj->order('add_time desc')->where("user_id = $id")->page($p,$page_size)->select();
                $data_num = $obj->where("user_id = $id")->select();
            }else{
                $data = $obj->order('add_time desc')->where("user_id = $id and do_type='$reward'")->page($p,$page_size)->select();
                $data_num = $obj->where("user_id = $id and do_type='$reward'")->select();
            }
        }else{
            if($reward == ""){
                $data = $obj->order('add_time desc')->where("user_id = $id and add_time = '$time'")->page($p,$page_size)->select();
                $data_num = $obj->where("user_id = $id and add_time = '$time'")->select();
            }else{
                $data = $obj->order('add_time desc')->where("user_id = $id and add_time = '$time' and do_type='$reward'")->page($p,$page_size)->select();
                $data_num = $obj->where("user_id = $id and add_time = '$time' and do_type='$reward'")->select();
            }
        }
        //分页
        $count = count($data_num);
        $Page = new \Common\Util\MyPage($count,$page_size);
        $show = $Page->show();
        $this->assign("page",$show);
        $this->assign("data",$data);
        //获取奖励的类型
        $reward_type = C('BUSINESS_TYPE');
        $this->assign('reward_type',$reward_type);
        //标识页面
        $user_type_url = U("user/$type");
        $this->assign("user_type_url", $user_type_url);
        //页面标题
        $this->assign("page_title","资金明细");
        //搜索内容返回
        $this->assign("time",$time);
        $this->assign("reward",$reward);
        //渲染模板
        $this->assign("id",$id);
        $this->display("user_capital");
    }

    /**
     * 修改密码
     */
    public function modify_pwd() {
        $id = trim(isset($_POST['id']) ? $_POST['id'] : "");
        $newpwd = isset($_POST['new_pwd']) ? $_POST['new_pwd'] : "";
        if($id == ""){
            $this->error("缺少参数");
            die();
        }
        $obj = M('user');
        //获取原密码
        $data = $obj->where("id=$id")->field("pwd")->select();
        if(md5($newpwd) == $data[0]['pwd']){
            $this->error("与原密码相同");
            die();
        }
        //保存新密码
        $obj->pwd = md5($newpwd);
        $rs = $obj->where("id=$id")->save();
        if ($rs) {
            $this->success("修改成功");
        } else {
            $this->error("修改失败");
        }
    }


    /**
     * 添加用户表单
     */
    public function user_add_form(){
        $name =trim(isset($_POST['name'])?$_POST['name']:"");
        if($name == ""){
            $this->error("非法操作");
        }
        $real_name =trim(isset($_POST['real_name'])?$_POST['real_name']:"");
        $tel =trim(isset($_POST['tel'])?$_POST['tel']:"");
        $age =trim(isset($_POST['age'])?$_POST['age']:"");
        $sex =trim(isset($_POST['sex'])?$_POST['sex']:"");
        $province_id =trim(isset($_POST['province_id'])?$_POST['province_id']:"");
        $city_id =trim(isset($_POST['city_id'])?$_POST['city_id']:"");
        $district_id =trim(isset($_POST['district_id'])?$_POST['district_id']:"");
        $address =trim(isset($_POST['address'])?$_POST['address']:"");
        $identity =trim(isset($_POST['identity'])?$_POST['identity']:"");
        $is_validated =trim(isset($_POST['is_validated'])?$_POST['is_validated']:"");
        $identity_img =trim(isset($_POST['identity_img'])?$_POST['identity_img']:"");
        $money =trim(isset($_POST['money'])?$_POST['money']:"");
        $integral =trim(isset($_POST['integral'])?$_POST['integral']:"");
        $user_type =trim(isset($_POST['user_type'])?$_POST['user_type']:"");
        $pwd =trim(isset($_POST['pwd'])?$_POST['pwd']:"");
        $level_id =trim(isset($_POST['level'])?$_POST['level']:"");
        function guid(){
            $user_guid = create_guid();
            $obj = M('user');
            //判断guid
            $data_guid = $obj->where("guid = '$user_guid'")->select();
            if (count($data_guid)!= 0){
                guid();
            }else{
                return $user_guid;
            }
        }
        $user_guid = guid();
        //查询每月粉丝位数量
        $options = M("options");
        $sql = "select `value` from tf_options WHERE `key`='month_fans_max'";
        $month_fans_num = $options->query($sql);
        $month_fans_num = $month_fans_num[0]['value'];
        $data = array(
            'name'=>$name,
            'real_name'=>$real_name,
            'tel'=>$tel,
            'age'=>$age,
            'sex'=>$sex,
            'province_id'=>$province_id,
            'city_id'=>$city_id,
            'district_id'=>$district_id,
            'address'=>$address,
            'identity'=>$identity,
            'is_validated'=>$is_validated,
            'identity_img'=>$identity_img,
            'money'=>$money,
            'integral'=>$integral,
            'user_type'=>$user_type,
            'pwd'=>md5($pwd),
            'add_time'=>date("Y-m-d",time()),
            'level_id'=>$level_id,
            'guid'=>$user_guid,
            'month_fans'=>$month_fans_num,
            'month'=>date("Y-m-d H:i:s",time()),
            'fans_end_time'=>date("Y-m-d",time()+63072000)
        );
        $obj = M('user');
        //判断用户名
        $data_name = $obj->where("name='$name'")->select();
        if (count($data_name)!= 0){
            $this->error("用户名已存在");
            die();
        };
        //判断省市区代理是否存在
        if($user_type == 'province_agent'){
            $data_province = $obj->where("user_type='$user_type' and province_id=$province_id")->select();
            $province_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
            if (count($data_province)!= 0){
                $this->error($province_name['region_name']."代理已存在,请重新添加。");
                die();
            };
        }else if($user_type == 'city_agent'){
            $data_city = $obj->where("user_type='$user_type' and city_id=$city_id")->select();
            $city_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
            if (count($data_city)!= 0){
                $this->error($city_name['region_name']."代理已存在,请重新添加。");
                die();
            };
        }else if($user_type == 'district_agent'){
            $data_district = $obj->where("user_type='$user_type' and district_id=$district_id")->select();
            $district_name = M()->table("tf_region")->where("region_id=$province_id")->field("region_name")->find();
            if (count($data_district)!= 0){
                $this->error($district_name['region_name']."代理已存在,请重新添加。");
                die();
            };
        }
       
        //判断身份证号码
        $data_identity = $obj->where("identity = '$identity'")->select();
        if (count($data_identity)!= 0){
            $this->error("该身份证号码已被注册");
            die();
        };
        //判断电话号码
        $data_tel = $obj->where("tel = '$tel'")->select();
        if (count($data_tel)!= 0){
            $this->error("该电话号码已被注册");
            die();
        };
        $rs = $obj->add($data);
        if($rs){
            $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }

    }

    //团队详情
    public function team_detail() {
        $ids = trim(isset($_GET['ids'])?$_GET['ids']:"");
        //筛选数据
        $obj = M('user');
        $sql = "select `name`,`tel` from tf_user WHERE id IN ($ids)";
        $data = $obj->query($sql);
        echo json_encode($data);
    }

}
