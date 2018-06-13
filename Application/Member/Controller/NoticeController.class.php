<?php
namespace Member\Controller;
use Think\Controller;
use Common\Util;
/*我的消息
 * Class NoticeController
 * @package Member\Controller
 */

class NoticeController extends BaseController
{
    public function index ()
    {
        //拉取数据
        $user = $this->getUser();
        $user_id = $user['id'];
        $db = M("notices");
        $count = $db->where("userid=$user_id or type='all'")->count();//当前总条数
        $page_size = C("PAGE_SIZE");
        $pages = new Util\MyPage($count,$page_size);
        $pages->setConfig('prev', '上一页');
        $pages->setConfig('next', '下一页');
        //每页显示的内容
        $rows = $db->where("userid=$user_id or type='all'")->order("`add_time` Desc")->limit($pages->firstRow . ',' . $pages->listRows)->select();
        $show = $pages->show();
        $active = "active";//增加样式
        $p = $_GET['p'];//当前页数
        $this->assign("p",$p);
        $this->assign("active",$active);
        $this->assign("pages", $show);
        $this->assign("rows", $rows);

        //页面标题
        $this->assign("page_title", "我的消息");
        //模版渲染
        $this->display();
    }
    /**
     * 动态获取消息
     */
    public function ajax_message() {
        $id = $_GET['id'];
        $db = M("notices");

        $data = $db->where("id = $id")->find();
        if ($data) {
            //更改状态
            $db->where("id=$id")->data(array('view'=>1))->save();
            echo json_encode($data);
            exit;
        } else {
            echo 'error';
            exit;
        }


    }

}