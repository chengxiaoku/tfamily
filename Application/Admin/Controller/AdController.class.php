<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;
use Think\Session\Driver\Memcache;
use Common\Util;

/**
 * 广告页面控制器
 * Class AdController
 * @package Admin\Controller
 * @author *** 598420812@qq.com
 * @date 2016-11-11
 */
class AdController extends BaseController
{

    /**
     * 首页
     */
    public function index()
    {

        $User = M('adspace');
        $num = C('PAGE_SIZE');
        $count = $User->count();
        //每页数据数
        $Page = new Util\MyPage($count, $num);
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        // 赋值分页输出
        $this->assign('page', $show);


        $p = I('get.p','','trim');
        if(empty($p)){
            $p = 1;
        }
        $start_page = ($p-1)*$num;
        $data = M()->table('tf_adspace as a')->field('a.title,a.width,a.height,a.id')->order('add_time desc')->limit($start_page,$num)->select();
        foreach ($data as $key => $val) {
            $dome[$key] = array(
                'title' => $val['title'],
                'width' => $val['width'],
                'height' => $val['height'],
                'id' => $val['id']
            );
            $dome[$key]['count'] = M('ads')->where("space_id=$val[id]")->count();
        }

        $this->assign("data", $dome);


        //页面标题
        $this->assign("page_title", "广告管理");

        //渲染模板
        $this->display();
    }
    
    //根据用户电话搜索用户
    public function user_tel (){
        $tel = I("get.tel","","trim");
        $name = M()->table("tf_user")->where("tel=$tel")->field("id")->find();
        echo $name['id'];
    }

    public function ad_add()
    {
        
        
        
        if (I('get.id') == '') {

            $space_id = I('get.space_id');
            $data = M('adspace')->field('id as space_id,title as space_title,type as content')->where("id=$space_id")->select();
            $this->assign("list", $data);
            $user = M('user')->field('id,name')->select();
            $this->assign("user", $user);
            //页面标题
            $this->assign("page_title", "添加广告");
        } else {
            $id = I('get.id');
            $data = M('ads')->where("id=$id")->select();
            $space_id = $data[0]['space_id'];
            $temp = M('adspace')->field('id,title,type')->where("id=$space_id")->select();
            $data[0]['space_title'] = $temp[0]['title'];
            $data[0]['content'] = $temp[0]['type'];

            switch ($data[0]['content'])
            {
                case 'banner':
                    $data[0]['ad_content'] = unserialize($data[0]['ad_content']);
                    break;
                case 'images':
                    $data[0]['ad_content'] = unserialize($data[0]['ad_content']);
                    break;
                case 'text':
                    $data[0]['ad_content'] = unserialize($data[0]['ad_content']);
                    break;
            };
             
            
            
            $this->assign("list",$data);
            $length = 0;
            foreach ($data[0]['ad_content'] as $key=>$value){
                $length = $key;
            }
            $this->assign("length",$length);
            $user = M('user')->field('id,name')->select();
            $this->assign("user", $user);
            $this->assign("page_title", "修改广告");
        }

        /**
         * 手机号搜索客户
         */
        if (I('get.tel')) {
            $tel = I('get.tel', '', 'trim');
            if (empty($tel)) {
                $this->success('页面访问出错！', U('ad/index'), 3);
                exit();
            }

            $search = M('user')->field("id,tel")->select();
           
            for($i = 0; $search[$i][tel]; $i++)
            {
                if($tel == $search[$i][tel])
                {
                    $this->assign("search", $search[$i][id]);
                }else{
                    $this->assign("search_text",'未找到该手机号');
                }
            }

            
        }
        
        //渲染模板
        $this->display();
    }

    public function add_ad()
    {
        if (!IS_POST) {
            $this->error('访问的页面不存在', U('index/index'));
        }
        if (I('post.content')) {
            $content = I('post.content');

            switch ($content)
            {
                case 'banner':
                    $data = I('post.banner');                    
                    $type = serialize($data);
                    break;
                case 'images':
                    $data = I('post.images');
                    $type = serialize($data);
                    break;
                case 'text':
                    $data = I('post.text');
                    $type = serialize($data);
                    break;                
            }
        }
        header('Content-type:text/html;charset=utf-8');
        $data = array(
            'title' => I('post.name'),
            'space_id' => I('post.space_id'),
            'start_time' => I('post.begin-time'),
            'end_time' => I('post.end-time'),
            'money' => I('post.money'),
            'content' => I('post.content'),
            'user_id' => I('post.user_id'),
            'ad_content' => $type
        );


        if (I('post.id') == '') {

            $dataadd = M('ads')->data($data)->add();
            if ($dataadd) {
                $this->success('广告增添成功！', U('ad/index'));
            } else {
                $this->error('广告增添失败！', U('ad/index'));
            }
        } else {
            $dataadd = M('ads')->where('id=' . I('post.id'))->save($data);
            if ($dataadd) {
                $this->success('广告修改成功！', U('ad/index'));
            } else {
                $this->error('广告修改失败！', U('ad/index'));
            }

        }
    }

    public function ad()
    {
        if (!(isset($_GET["id"]))) {
            $this->success('页面访问出错！', U('ad/index'), 3);
            exit();
        }

        $id = $_GET["id"];
        $User = M('ads')->where("space_id=" . $id);
        $num = C('PAGE_SIZE');
        $count = $User->count();
        //每页数据数
        $Page = new Util\MyPage($count, $num);
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        // 赋值分页输出
        $this->assign('page', $show);


        $p = I('get.p','','trim');
        if(empty($p)){
            $p = 1;
        }
        $start_page = ($p-1)*$num;
        
        $data = M('ads')->where("space_id=" . $id)->limit($start_page,$num)->select();
        $temp = M('adspace')->field('title')->where("id=$id")->select();
        $temo = $temp[0]['title'];
        $this->assign("space_id",$id);
        $this->assign("title", $temo);
        $this->assign("list", $data);
        //页面标题
        $this->assign("page_title", "广告列表");
        //渲染模板
        $this->display();
    }

    public function ad_del()
    {
        if (!(isset($_GET["id"]))) {
            $this->success('页面访问出错！', U('ad/index'), 3);
            exit();
        }
        $id = $_GET['id'];
        $datadel = M('ads')->where("id=" . $id)->delete();
        if ($datadel) {
            $this->success('广告删除成功！', U('ad/index'));
        } else {
            $this->error('广告删除失败！', U('ad/index'));
        }
    }

    public function ads_add()
    {
        if (I('get.id') == '') {
            //页面标题
            $this->assign("page_title", "添加广告位");
        } else {
            $id = I('get.id');
            $data = M('adspace')->field('id,title,type,description,width,height')->where("id=$id")->select();
            $this->assign("list", $data);
            //页面标题
            $this->assign("page_title", "修改广告位");
        }
        //渲染模板
        $this->display();
    }

    public function add_ads()
    {
        if (!IS_POST) {
            $this->error('访问的页面不存在', U('index/index'));
        }

        header('Content-type:text/html;charset=utf-8');
        $data = array(
            'title' => I('post.title'),
            'type' => I('post.type'),
            'width' => I('post.width'),
            'height' => I('post.height'),
            'description' => I('post.description'),
            'add_time' => date('Y-m-d H:i:s', time())
        );
        if (I('post.id') == '') {

            $dataadd = M('adspace')->data($data)->add();
            if ($dataadd) {
                $this->success('广告位增添成功！', U('ad/index'));
            } else {
                $this->error('广告位增添失败！', U('ad/index'));
            }
        } else {
            $dataadd = M('adspace')->where('id=' . I('post.id'))->save($data);
            if ($dataadd) {
                $this->success('广告位修改成功！', U('ad/index'));
            } else {
                $this->error('广告位修改失败！', U('ad/index'));
            }
        }
    }

    public function ads_del()
    {
        if (!(isset($_GET["id"]))) {
            $this->success('页面访问出错！', U('ad/index'), 3);
            exit();
        }
        $id = $_GET['id'];
        $datadel = M('adspace')->where("id=" . $id)->delete();
        if ($datadel) {
            $this->success('广告位删除成功！', U('ad/index'));
        } else {
            $this->error('广告位删除失败！', U('ad/index'));
        }

    }
    /**
     * 批量删除
     */
    public function del_all_adspace()
    {
        $del_id = I('get.id');
        $model = M('adspace');
        $data['id'] = array('in', $del_id);
        $rs = $model->where($data)->delete();
        $url = U("ad/index");
        if($rs !== false){
            $this->success("数据删除成功", $url);
        }else {
            $this->error("数据删除失败", $url);
        }
    }
    public function del_all_ad()
    {
        $del_id = I('get.id');
        $model = M('ads');
        $data['id'] = array('in', $del_id);
        $rs = $model->where($data)->delete();
        $url = U("ad/index");
        if($rs !== false){
            $this->success("数据删除成功", $url);
        }else {
            $this->error("数据删除失败", $url);
        }
    }




    /**
     * 空白页面 - 演示
     */
    public function page()
    {
        $this->display();
    }

    /**
     * UI参考页面 - 演示
     */
    public function ui()
    {
        $this->display();
    }

}