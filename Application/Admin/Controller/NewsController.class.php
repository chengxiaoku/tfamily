<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Page;

/**
 * 新闻管理控制器
 * Class NewsController
 * @package Admin\Controller
 * @author qxx 2315400689@qq.com
 * @date 2016-11-11
 */
class NewsController extends BaseController {

    /**
     * 首页
     */
    public function index() {
        $tf_news = M('news');// 实例化数据对象
        $num = C("PAGE_SIZE");//调用每页显数量
        $count =$tf_news->count();// 查询总记录数
        $page =new page($count,$num);// 实例化分页类 传入总记录数
        $limit=$page->firstRow.','.$page->listRows;
        $data = $tf_news->order('add_time DESC')->limit($limit)->select();//进行分页查询
        $page->setConfig('prev','上一页');
        $page->setConfig('next','下一页');
        $page=$page->show();// 分页显示输出
        $this->assign("list",$data);// 赋值数据集
        $this->assign("page",$page);// 赋值分页输出
        //页面标题
        $this->assign("page_title", "新闻管理");
        //渲染模板
        $this->display();
    }
   
    public function add() {
        //获取下拉框栏目
            $category = M("category");
            $data = $category->where(array('type' => 'category'))->select();//获取栏目名
            $this->assign('lists',$data);
        //提交添加
        if (IS_POST) {
            //获取数据
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $catid = isset($_POST['catid']) ? $_POST['catid'] : null;
            $thumb = isset($_POST['thumb']) ? $_POST['thumb'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $content = isset($_POST['content']) ? $_POST['content'] : null;
            $views = isset($_POST['views']) ? $_POST['views'] : null;
            //移除字符串两侧字符
            $title = trim($title);
            $catid = trim($catid);
            $thumb = trim($thumb);
            $description = trim($description);
            $content = trim($content);
            $views = trim($views);
            //判断标题是否为空
            if (empty($title)) {
                $this->error("非法操作：无标题参数");
            }
            $data = array(
                "title" => $title,
                "catid" => $catid,
                "thumb" => $thumb,
                "description" => $description,
                "content" => $content,
                "views" => $views,
                "add_time" =>date("Y-m-d H:i:s",time())
            );
            $news = M("news");
            $result = $news->add($data);//插入数据
            //判断数据是否添加成功
            if (!$result) {
                $this->error("添加失败",U('News/index'));
            } else {
                $this->success("添加成功",U('News/index'));
            }
        } else {
            //页面标题
            $this->assign("page_title","添加新闻");
            //渲染模板
            $this->display();
        }

    }


    /**
     * 修改显示
     */
    public function upd(){
        //获取下拉框栏目
        $category = M("category");
        $category = $category->where(array('type' => 'category'))->select();
        $this->assign('category', $category);
        //从数据库获取数据
        $id = $_GET['id'];
        if ($id) {
            $news = M("news");
            $data = $news->where("id=$id")->find(); //对需要修改的数据进行查询
            //向编辑页抛要修改的数据
            $this->assign('lists', $data); // 赋值数据集
            $category_id = $data['catid'];
            //判断 $category_id 是否存在
            if ($category_id) {
                $category = M("category");
                $arr = $category->where("id=$category_id")->find(); //对需要修改数据的栏目名进行查询
                $this->assign('arr', $arr); // 赋值数据集
            }else{
                $this->assign("page_title", "修改新闻");
                $this->display();
            }
        } else {
            $this->error("非法操作：无参数ID");
        }
        //页面标题
        $this->assign("page_title", "修改新闻");
        //渲染模板
        $this->display();
    }

    /**
     * 提交修改
     */
    public function up(){
        
        if (IS_POST) {
            //获取数据
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $title = isset($_POST['title']) ? $_POST['title'] : null;
            $catid = isset($_POST['catid']) ? $_POST['catid'] : null;
            $thumb = isset($_POST['thumb']) ? $_POST['thumb'] : null;
            $description = isset($_POST['description']) ? $_POST['description'] : null;
            $content = isset($_POST['content']) ? $_POST['content'] : null;
            $views = isset($_POST['views']) ? $_POST['views'] : 0;
            $title = trim($title);
            //判断$title是否存在
            if (empty($title)) {
                $this->error("非法操作：无标题参数",U('News/index'));
            }
            if (empty($id)) {
                $this->error("非法操作：缺少参数id",U('News/index'));
            }
            $data = array(
                "title" =>  $title,
                "catid" => $catid,
                "thumb" => $thumb,
                "description" => $description,
                "content" => $content,
                "views" => $views,
                "add_time" =>date("Y-m-d H:i:s",time())
            );
            $news = M("news");
            $result = $news->where("id=$id")->save($data);//向数据库修改数据
            //判断是否修改成功
            if (!$result) {
                $this->error("修改失败", U('News/upd'));
            } else {
                $this->success("修改成功", U('News/index'));
            }
        } else {
            //页面标题
            $this->assign("page_title", "修改新闻");
            //渲染模板
            $this->display();
        }


    }
    /*
     * 删除数据
     */
    public function del () {
        //获取id
        $id = $_GET['id'];
        //判断$id是否存在
        if($id){
            $news = M('news');
            $data['id'] = array('in', $id);
            $result = $news->where($data)->delete();//删除所选数据
            //判断数据是否删除
            if (!$result) {
                $this->error("删除失败",U('News/index'));
            } else {
                $this->success("删除成功",U('News/index'));
            }
        }else{
            $this->error("非法操作：缺少ID",U('News/index'));
        }
    }

    /**
     * 查询数据
     */
    public function sel(){
        //获取搜索内容
        $keyword = $_GET['keyword'];
        $keyword = trim($keyword);
        //判断搜索内容是否存在
        if ($keyword) {
            $tf_news = M('news');
            $num = C("PAGE_SIZE");//调用每页显数量
            $arr['title'] = array('like',"%$keyword%");
            $count =$tf_news->where($arr)->count();// 查询总记录数
            $page =new page($count,$num);// 实例化分页类 传入总记录数
            $limit=$page->firstRow.','.$page->listRows;
            $data = $tf_news->order('add_time DESC')->limit($limit)->where($arr)->select();//进行分页查询
            $page->setConfig('prev','上一页');
            $page->setConfig('next','下一页');
            $page=$page->show();// 分页显示输出
            $this->assign("list",$data);// 赋值数据集
            $this->assign("page",$page);// 赋值分页输出
            $this->assign("list",$data);
            //页面标题
            $this->assign("page_title", "新闻管理");
            //渲染模板
            $this->display();
        }else{
            $this->error("非法操作：无参数");
        }
    }
  
}