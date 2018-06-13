<?php
namespace Member\Controller;
use Member\Controller\BaseController;
use Common\Util\SearchPage;
use Common\Util\AjaxPage;
/**
 * Created by PhpStorm.
 * User: yzq
 * Date: 2016/11/14
 * Time: 9:27
 */
class TeamController extends BaseController {
    public $teams = ''; //当前用户的会员等级所对应的最低团队人数数量
    public $user_id = ''; //当前用户的用户id
    public $user_name = ''; //当前用户名称
    /*
     * 获取当前用户的id
     * 和用户所在等级
     */
    public function __construct() {
        parent::__construct();
        $user = $this->getUser();
        $this->user_id = $user['id'];
        $this->user_name = $user['name'];
        $user = M('user');
        $level_id_arr = $user->where("id=$this->user_id")->field('level_id')->select();
        $level_id = $level_id_arr[0]['level_id'];
        $level = M('level');
        $teams_arr = $level->where("id=$level_id")->field('teams')->select();
        $this->teams = $teams_arr[0]['teams'];
    }
    /*
     * 拉取数据并分页
     */
    public function Index() {
        $team = M('team'); // 实例化User对象
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C('PAGE_SIZE');
        $list = $team->order('add_time desc')->where("owner = $this->user_id")->page($page,$page_size)->select();
        $this->assign('list',$list);// 赋值数据集
        $count = $team->where("owner = $this->user_id")->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $this->assign("teams",$this->teams);
        $this->assign('page',$show);// 赋值分页输出
        session("search_val",null);
        $this->display(); // 输出模板
    }
    /*
     * ajax团队详情
     */
    public function detail() {
        if (IS_GET) {
            $detail = M('team');
            $id = I('get.id');
            $data = $detail->where("id=$id")->select();
            $ids = $data[0]['members_ids'];
            $user = new \Think\Model();
            if ($ids == '') {
                $date = '';
            } else {
                $date = $user->query("select name,tel from tf_user where id in ($ids)");
            }
            echo json_encode($date);
        }
    }
    /*
     * 搜索团队
     */
    public function search() {
        $content = I('post.search');
        if (!empty($content)) {
            session("search_val", $content);
        }
        $content = empty($content) ? session('search_val') : $content;
        $team = M('team');
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C('PAGE_SIZE');
        $data = $team->where("owner = $this->user_id and members_names like '%$content%'")->page($page, $page_size)->select();
        $count = $team->where("owner = $this->user_id and members_names like '%$content%'")->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count, $page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('para', 'parameter ');
        $this->assign('list', $data);
        $this->assign('content',$content);
        $this->assign("teams", $this->teams);
        $this->display('index');
    }
    /*
     * 解散团队
     */
    public function dissolve() {
        if (IS_GET) {
            $id = I('get.id');
            if ($id != '') {
                $del = M('team');
                $result = $del->where("owner=$this->user_id and id=$id")->delete();
                if ($result==false & $result==0) {
                    $this->error("非法操作",U('Team/index'));
                } else {
                    $this->success("解散成功",U('Team/index'));
                }
            } else {
                $this->error("缺少参数",U('Team/index'));
            }
        } else {
            $this->error("页面不存在",U('Team/index'));
        }
    }
    /*
     * ajax拉取待添加成员
     */
    public function add_user() {
        if (IS_GET) {
            $user = M('user');
            $team = M('team');
            $team_id = I('get.id');

            $page = isset($_GET['p']) ? $_GET['p'] : 1;
            $page_size = C('PAGE_SIZE');

            $user_ids = $team->where("owner=$this->user_id")->field("members_ids")->select();
            $users_ids = '';
            foreach ($user_ids as $k=>$v) {
                $users_ids.=$v['members_ids'].',';
            }
            $users_ids = str_replace("$this->user_id,",'' , $users_ids);
            $users_ids = trim($users_ids,',');
            if ($users_ids == '') {
                $data = $user->where("parentid=$this->user_id and id !=$this->user_id and user_type = 'member' and status = 'enabled' and is_validated = 'yes'")->page($page,$page_size)->select();
                $count = $user->where("parentid=$this->user_id and id !=$this->user_id and user_type = 'member' and status = 'enabled' and is_validated = 'yes'")->count();
            } else {
                $data = $user->where("parentid=$this->user_id and id not in ($users_ids,$this->user_id) and user_type = 'member' and status = 'enabled' and is_validated = 'yes'")->page($page,$page_size)->select();
                $count = $user->where("parentid=$this->user_id and id not in ($users_ids,$this->user_id) and user_type = 'member' and status = 'enabled' and is_validated = 'yes'")->count();
            }
            $Page = new AjaxPage($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show = $Page->show();// 分页显示输出
            $this->assign("data",$data);
            $this->assign("team_id",$team_id);
            $this->assign("page",$show);
            session("ajax_search",null);
            $this->display("search");
        }
    }
    /*
     * ajax搜索待添加成员
     */
    public function ajax_search() {
        $key = $_GET['key'];
        $team_id = I('get.id');
        $user = M('user');
        $team = M('team');
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C('PAGE_SIZE');
        if (!empty($key)) {
            session("ajax_search",$key);
        }
        $key = empty($key)?session("ajax_search"):$key;

        $user_ids = $team->where("owner=$this->user_id")->field("members_ids")->select();
        $users_ids = '';
        foreach ($user_ids as $k=>$v) {
            $users_ids.=$v['members_ids'].',';
        }
        $users_ids = str_replace("$this->user_id,",'' , $users_ids);
        $users_ids = trim($users_ids,',');
        if ($users_ids == '') {
            $data = $user->where("parentid=$this->user_id and user_type = 'member' and id !=$this->user_id and status = 'enabled' and is_validated = 'yes' and (name like '%$key%' or real_name like '%$key%' or age like '%$key%' or sex like '%$key%' or tel like '%$key%')")->page($page,$page_size)->select();
            $count = $user->where("parentid=$this->user_id and user_type = 'member' and id !=$this->user_id and status = 'enabled' and is_validated = 'yes' and (name like '%$key%' or real_name like '%$key%' or age like '%$key%' or sex like '%$key%' or tel like '%$key%')")->count();
        } else {
            $data = $user->where("parentid=$this->user_id and id not in ($users_ids,$this->user_id) and user_type = 'member' and status = 'enabled' and is_validated = 'yes' and (name like '%$key%' or real_name like '%$key%' or age like '%$key%' or sex like '%$key%' or tel like '%$key%')")->page($page,$page_size)->select();
            $count = $user->where("parentid=$this->user_id and id not in ($users_ids,$this->user_id) and user_type = 'member' and status = 'enabled' and is_validated = 'yes' and (name like '%$key%' or real_name like '%$key%' or age like '%$key%' or sex like '%$key%' or tel like '%$key%')")->count();
        }
        $Page = new SearchPage($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $this->assign("data",$data);
        $this->assign("team_id",$team_id);
        $this->assign("page",$show);
        $this->display("search");
    }
    /*
     * 添加成员
     */
    public function add_form() {
        $member_id = I('post.checkbox');  //选中的成员id
        $team_id = I('post.team_id');  //所在团队id
        //拼接选中的成员id
        $ids = '';
        foreach ($member_id as $value) {
            $ids .= ','.$value;
        }
        //将两边 , 过滤
        $name_ids = trim($ids,',');
        //筛选选中id在user数据库中的昵称
        $user = M('user');
        $name = $user->where("id in($name_ids)")->field('name')->select();
        //拼接筛选出来的昵称
        $names = '';
        foreach ($name as $k=>$v) {
            $names.= $v['name'] .',';
        }
        //筛选出当前所在团队中的数据
        $team = M('team');
        $team_arr = $team->where("id=$team_id")->select();
        //获取所在团队中已有的ids、names、num
        $team_ids = $team_arr[0]['members_ids'];
        $members_names = $team_arr[0]['members_names'];
        $num = $team_arr[0]['num'];
        //将选中的和数据库中已有的ids和names拼接在一起
        $ids = $team_ids.$ids;
        $names = $names.$members_names;
        //计算最新的团队人数数量
        $count = count($member_id)+$num;
        //更新数据库
        $data['members_names'] = $names;
        $data['members_ids'] = $ids;
        $data['num'] = $count;
        if ($count > $this->teams) {
            $this->error("人数超过限制",U('Team/index'));
        } else if ($count == $this->teams) {
            $user = M('user');
            $level_id_arr = $user->where("id=$this->user_id")->field('level_id')->select();
            $level_id = $level_id_arr[0]['level_id'];
            $level = M('level');
            $award_teams = $level->where("id=$level_id")->field("award_team")->select();
            $award_team = $award_teams[0]['award_team'];
            $money = array(
                'user_id'=>$this->user_id,
                'money' => $award_team,
                'do_type' => 'award_team',
                'add_time' => date('Y-m-d H-i-s',time()),
                'description' => '组团奖励',
                'status' => 'pending'
            );
            $money_details = M('money_details');
            $money_details->add($money);
            
            $data['status'] = 'yes';
            $result = $team->where("id=$team_id")->save($data);
            if ($result!=1) {
                $this->error("添加成员失败",U('Team/index'));
            } else {
                $this->success("添加成员成功",U('Team/index'));
            }
        } else {
            $result = $team->where("id=$team_id")->save($data);
            if ($result!=1) {
                $this->error("添加成员失败",U('Team/index'));
            } else {
                $this->success("添加成员成功",U('Team/index'));
            }
        }
    }
    /*
     * 创建团队
     */
    public function create() {
        $team = M('team');
        $data = array(
            'owner' => $this->user_id,
            'members_names' => $this->user_name,
            'members_ids' => $this->user_id,
            'num' => 1,
            'status' => 'no',
            'add_time' => date("Y-m-d H-i-s",time())
        );
        $result = $team->add($data);
        if ($result) {
            $this->success("创建成功",U('Team/index'));
        } else {
            $this->error("创建失败",U('Team/index'));
        }
    }

}