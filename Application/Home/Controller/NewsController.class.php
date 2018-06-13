<?php
namespace Home\Controller;
use Home\Controller\BaseController;
use Common\Util;
/**
 * 新闻控制器
 * Class IndexController
 * @package Home\Controller
 * @author lgj
 * @date 2016-11-21
 */

class NewsController extends BaseController{
    //新闻首页
    public function index(){
        $db=M('news');
        $cat_db = M('category');
        $cat = $cat_db->where("name='房产热点'")->select();
        $hotid  =$cat[0]['id'];
        $cat = $cat_db->where("name='热门百科'")->select();
        $catid=$cat[0]['id'];

        $data = $db->order('add_time desc')->limit(5)->select();
        $count = $db->count();
        $hot  =$db->where("catid=$hotid")->order("add_time desc")->limit(4)->select();
        $this->assign('hot',$hot);
        $baike  =$db->where("catid=$catid")->order('add_time desc')->limit(4)->select();
        $this->assign('baike',$baike);
        $this->assign('news',$data);
        $this->assign('count',$count);

        $this->assign('page_title','公告');
        $this->display();
    }


    public function news(){
        $id = isset($_GET['id']) ? $_GET['id'] : "";
        $db = M('news');
        $cat_db = M('category');
        $cat = $cat_db->where("name='房产热点'")->select();
        $catid =$cat[0]['id'];
        $cat = $cat_db->where("name='热门百科'")->select();
        $hotid =$cat[0]['id'];

        $data = $db->where("id = $id")->find();
        $hot  =$db->where("catid=$catid")->order('add_time desc')->limit(5)->select();
        $this->assign('hot',$hot);
        $baike  =$db->where("catid=$hotid")->order('add_time desc')->limit(5)->select();
        $this->assign('baike',$baike);
        $this->assign('news',$data);
        $this->assign('page_title','公告详情');
        $this->display();
    }
    public function  news_data(){
        $start = I('post.starts');                  //拉取数据起始值
        $db = M('news');
        $datas = $db->limit($start,4)->order('add_time desc')->select();
        $this->ajaxReturn($datas);
    }
    
}