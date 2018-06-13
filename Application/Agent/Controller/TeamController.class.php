<?php
namespace Agent\Controller;
use Common\Util;
use Common\Util\SearchPage;
use Common\Util\AjaxPage;

/**
 * 我的团队控制器
 * Class TeamController
 * @package Admin\Controller
 * @author xll 1021238171@qq.com
 * @date 2016-11-11
 */

header('Content-type:text/html;charset=utf-8');

class TeamController extends BaseController
{
    public $teams = '';
    public $user_id = '';
    public $user_name = '';

    //获取当前用户的id和用户所在等级

    public function __construct()
    {
        parent::__construct();
        $user = $this->getUser();
        $this->user_id = $user['id'];
        $this->user_name = $user['name'];
        $user = M('user');
        $data['id'] = $this->user_id;
        $level_id_arr = $user->where($data)->field('level_id')->select();
        $level_id = $level_id_arr[0]['level_id'];
        $level = M('level');
        $teams_arr = $level->where("id=$level_id")->field('teams')->select();
        $this->teams = $teams_arr[0]['teams'];

    }

    //首页
    public function index()
    {
        $team = M('team'); // 实例化User对象
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $page_size = C('PAGE_SIZE');
        $list = $team->order('add_time desc')->where("owner = $this->user_id")->page($page, $page_size)->select();
        $count = $team->where("owner = $this->user_id")->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count, $page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $this->assign('list', $list);
        $this->assign("teams", $this->teams);
        $this->assign("page_title", "我的团队");
        $this->assign('page', $show);
        session('search_val','');
        $this->display();

    }

    //添加会员显示AJAX
    public function addMember()
    {
        $tf_user = M('user');
        $tf_team = M('team');
        $page = I('get.p');
        $teamid = I('get.teamid');
        $page_size = C('PAGE_SIZE');

        //筛选出已经存在的成员

      $data['id'] = $teamid;
        $team_members_id = $tf_team->where($data)->select();

        $arrs = array();
        foreach ($team_members_id as $value) {
            $team_members_id = $value['members_ids'];
            $arrs = explode(',',$team_members_id);

        }

        $datas['user_type'] = 'member';
        $datas['is_validated'] = 'yes';
        $datas['parentid'] = $this->user_id;
        $data_member = $tf_user->where($datas)->select();
        $arr = array();
        foreach ($data_member as $value) {
            $members_ids = $value['id'];
            array_unshift($arr, $members_ids);

        }
        for ($j = 0; $j < count($arrs); $j++) {

            for ($i = 0; $i <= count($arr); $i++) {
                if ($arrs[$j] == $arr[$i]) {
                    unset($arr[$i]);
                } else {

                }
            }
        }
 

        $id = '';
        foreach ($arr as $value) {
            $id .= $value . ",";
        }
        $id = trim($id, ",");
        $datas['id'] = array("in", "$id");
        $data = $tf_user->where($datas)->page($page, $page_size)->select();
        $count = $tf_user->where($datas)->count();
        $Page = new AjaxPage($count, $page_size);
        $show = $Page->show();
        $this->assign("data", $data);
        $this->assign("pages", $show);
        $this->assign("teamid", $teamid);
        session("ajax_search", null);
        $this->display("search");
    }

    // 增加成员
    public function add()
    {
        //要添加的成员id的数据
        $user = M('user');
        $members_ids = I('get.members_ids');
        $data['id'] = array('in', $members_ids);
        $result = $user->where($data)->select();
        $members_ids = I('get.members_ids');

        $members_ids = trim($members_ids, ",");
        if (empty($members_ids)) {
            $this->error("请选择会员");
            $this->display();
        }
        $data['owner'] = $this->user_id;
        $num = $user->where($data)->count();
        $str = '';
        $strid = '';
        foreach ($result as $value) {
            $str .= $value['name'] .= ',';
            $strid .= $value['id'] .= ',';
        }

        //要添加的成员id的数据  team
        $datas['id'] = I('get.teamid');
        $team = M('team');
        $results = $team->where($datas)->select();
        foreach ($results as $value) {
            $id = $value['id'];
            $members_names = $value['members_names'];
            $members_ids = $value['members_ids'];
            $teamnum = $value['num'];
        }

        $members_names .= $str;
        $members_ids .= $strid;
        $num = $num + $teamnum;
        $teams = $this->teams;
        if ($num == 9) {
            $status = 'yes';
        } else if ($num < 9) {
            $status = 'no';
        } else if ($num > 9) {

            $this->error("添加成员数量超过指定人数");
            $this->display('index');
        }
        $id = $_GET['teamid'];
        if (empty($id)) {
            $this->error("无团队ID");
            $this->display();
        } else {
            $data['members_names'] = $members_names;
            $data['members_ids'] = $members_ids;
            $data['num'] = $num;
            $data['status'] = $status;

            $result = $team->where("id=$id")->save($data);

            if (!$result) {
                $this->error("添加成员失败", U('Team/index'));
                $this->assign("page_title", "我的团队");

            } else {
                $this->success("添加成员成功", U('Team/index'));
                $this->assign("page_title", "我的团队");

            }


        }
    }

    //搜索
    public function search()
    {
        $team = M('team');
        $keyword = trim(I('post.keyword'));
        $keyword = empty($keyword) ? session('search_val') : $keyword;
        if (!empty($keyword)) {
            session("search_val", $keyword);
        }

        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $data = array(
            'members_names like ' . "'" . "%$keyword%" . "'",
            'owner' => $this->user_id
        );
        $page_size = C('PAGE_SIZE');
        $list = $team->where($data)->page($page, $page_size)->select();
        $count = $team->where($data)->count();// 查询满足要求的总记录数
        $Page = new \Common\Util\MyPage($count, $page_size);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $this->assign('list', $list);
        $this->assign("teams", $this->teams);
        $this->assign('page', $show);
        $this->assign('keyword', $keyword);
        $this->assign("page_title", "我的团队");
        $this->display('index');

    }

    //解散团队
    public function del($id)
    {
        $team = M('team');
        $data['id'] = array('in', $id);
        $result = $team->where($data)->delete();
        if (!$result) {
            $this->error("删除失败", U('Team/index'));
            $this->assign("page_title", "我的团队");

        } else {
            $this->success("删除成功", U('Team/index'));
            $this->assign("page_title", "我的团队");

        }
    }

    //ajax搜索电话
    public function searchtel()
    {
        $tf_user = M('user');
        $keyword = trim(I('get.keyword'));
        $teamid = I('get.teamid');
        if (!empty($keyword)) {
            session("search_val", $keyword);
        }
        $keyword = empty($keyword) ? session('search_val') : $keyword;
        $page = isset($_GET['p']) ? $_GET['p'] : 1;
        $datas = array(
            'parentid' => $this->user_id,
            'user_type' => 'member',
            'is_validated' => 'yes',
            'tel like ' . "'" . "%$keyword%" . "'",
        );
        $page_size = C('PAGE_SIZE');
        $data = $tf_user->where($datas)->page($page, $page_size)->select();
        $count = $tf_user->where($datas)->count();
        $Page = new SearchPage($count, $page_size);
        $show = $Page->show();
        $this->assign("data", $data);
        $this->assign('pages', $show);
        $this->assign("teamid", $teamid);
        $this->assign('keyword', $keyword);
        $this->display("search");


    }

    //ajax团队详情
    public function teamdet()
    {
        $id = $_GET['id'];
        if (empty($id)) {
            $this->error("无参数");
            $this->display();
        } else {
            $tf_team = M('team');
            $userdata['id'] = $id;
            $data = $tf_team->where($userdata)->select();
            foreach ($data as $value) {
                $members_ids = $value['members_ids'];
            }
            if (empty($members_ids)) {
                $this->error("获取不到该团队成员");
                $this->display();
            } else {
                $tf_user = M('user');
                $datas['id'] = array('in', $members_ids);
                $datass = $tf_user->where($datas)->select();
                echo json_encode($datass);
            }
        }


    }

    //创建团队
    public function createTeam()
    {
        $tf_team = M('team');
        $data['members_names'] = $this->user_name . ",";
        $data['members_ids'] = $this->user_id . ",";
        $data['num'] = 1;
        $data['owner'] = $this->user_id;
        $data['status'] = 'no';
        $data['add_time'] = date("Y-m-d H:i:s", time());
        $result = $tf_team->add($data);

        if (!$result) {
            $this->error("创建团队失败", U('Team/index'));
            $this->assign("page_title", "我的团队");

        } else {
            $this->success("创建团队成功", U('Team/index'));
            $this->assign("page_title", "我的团队");

        }

    }

}

