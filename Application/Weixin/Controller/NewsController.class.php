<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class NewsController extends BaseController {
    public function index() {
        $new = M('news');
        $news = $new->order('add_time desc')->limit(0,10)->select();
        $new_count = $new->count();
        $this->assign('new_num',$new_count);
        $this->assign('new',$news);
        
        $this->assign("page_title", "新闻列表");
        $this->display();
    }
    public function news_see_more() {
        $i = I('get.i');
        $new = M('news');
        $count = $new->count();
        if ($i >= $count){
            $news = $new->order('add_time desc')->limit(0,$count)->select();
        } else {
            $news = $new->order('add_time desc')->limit(0,$i)->select();
        }
        echo json_encode($news);
    }

    public function single() {
        $id = I('get.id');
        $date = M('news')->where("id=$id")->select();
        $catid = $date['0']['catid'];
        $cat = M('category')->where("id=$catid")->field('name')->select();
        $cat = $cat['0']['name'];
        $this->assign("date",$date);
        $this->assign('cat',$cat);
        $this->assign("page_title", "新闻详情");
        $this->display();
    }
}