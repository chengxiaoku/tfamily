<?php


namespace Admin\Controller;
use Admin\Controller\BaseController;
use Common\Util;

/**
 * 公告页面控制器
 * Created by PhpStorm.
 * User: 王俊璐 1336206540@qq.com
 * Date: 2016/11/11
 * Time: 13:57
 * Description: 描述
 */
class NoticeController extends BaseController{
    /*公告主页*/
    public function index () {
        //分页
        $Data = M('notices'); // 实例化Data数据对象  date
        $count = $Data->count();// 查询满足要求的总记录数
        $page_size = C("PAGE_SIZE");
        $Page = new Util\MyPage($count,$page_size);// 实例化分页类 传入总记录数
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询
        $list = $Data->limit($Page->firstRow.','.$Page->listRows)->select(); // $Page->firstRow 起始条数 $Page->listRows 获取多少条

        //将公告显示在页面上
        foreach ($list as $key=>$value){
            //前台数据
            $data[$key] = array(
                'id'=>$value['id'],
                'message' => $value['message'],
                'add_time' => $value['add_time'],
             );

            if ($value['type']=='all') {
                $data[$key]['type']="所有人";
            } else if ($value['type']=='range') {
                //将省市区拼起来
                //获取省
                $province = M('region')->field('region_name')->where("region_id = $value[province_id]")->find();
                //获取市
                $city = M('region')->field('region_name')->where("region_id = $value[city_id]")->find();
                //获取区
                $district = M('region')->field('region_name')->where("region_id = $value[district_id]")->find();
                $data[$key]['type']=$province['region_name'].$city['region_name'].$district['region_name'];
            } else if($value['type']=='one'){
                $user = M('user')->field('name')->where("id = $value[userid]")->find();
                $data[$key]['type']=$user['name'];
            }
        }


        $this->assign('data',$data);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        //公告页面标题
        $this->assign('page_title','公告管理');
        //渲染模板
        $this->display();
    }

    /*增添公告页*/
    public function notices_add () {
        //判断是增添还是编辑还是编辑个人公告
        if (I('get.id')!='') {
            $id = I('get.id');
            $data = M('notices')->where("id=$id")->find();
            //向编辑页抛要修改的数据
            $this->assign('data',$data);
            //进入编辑公告页面
            $this->assign('page_title','编辑公告');
        }else{
            //增添公告页面
            $this->assign('page_title','增添公告');
        }

        //渲染模板
        $this->display();
    }

    /*将增添的公告添加到数据库*/
    public function add () {
        if (!IS_POST) {
                $this->error('访问的页面不存在',U('index/index'));
        }
        //获取入库数据并过滤
        $message = I('message','','trim');
        $type = I('author','','trim');
        if($message == '' || $type == '') {
            $this->error('缺少数据',U('notice/index'));
        }

        //获取消息数据
        $data = array(
            'userid' => isset($_POST['userid']) ? $_POST['userid'] : '',
            'message' => $message,
            'view' => isset($_POST['view']) ? $_POST['view'] : '0',
            'type' =>$type,
            'add_time' => date("Y-m-d H:i:s",time()),
            'province_id' => isset($_POST['province_id']) ? $_POST['province_id'] : '',
            'city_id' =>isset($_POST['city_id']) ? $_POST['city_id'] : '',
            'district_id'=>isset($_POST['district_id']) ? $_POST['district_id'] : '',
        );

        //存入数据库
        $dataadd = M('notices')->data($data)->add();

        //判断是否存入
        if($dataadd){
            $this->success('消息发送成功！',U('notice/index'));
        }else{
            $this->error('消息发送失败！',U('notice/index'));
        }
    }

    /*将公告从数据库删除*/
    public function del () {
        if (!isset($_GET['id'])) {
            $this->error('访问的页面不存在',U('index/index'));
        }

        $data['id'] = array('in',I('get.id'));
        $del = M('notices')->where($data)->delete();
        if ($del) {
            $this->success('删除成功',U('notice/index'));
        }else{
            $this->error('删除失败',U('notice/index'));
        }
    }

    /*修改公告*/
    public function update(){
        if(!IS_POST){
            $this->error('页面不存在',U('notice/index'));
        }

        //入库前判断存入数据是否为空
        $message = I('message','','trim');
        $type = I('author','','trim');
        if($message == '' || $type == '') {
            $this->error('缺少数据',U('notice/index'));
        }

        //接收修改数据
        $date['message'] = I('post.message');
        $date['type'] = I('post.author');
        $date['add_time'] = date("Y-m-d H:i:s",time());
        $date['province_id'] = I('post.province_id');
        $date['city_id'] = I('post.city_id');
        $date['district_id'] = I('post.district_id');
        $date['id'] = I('hiddens');
        $updata = M('notices')->where("id=$date[id]")->save($date);
        if($updata){
            $this->success('公告修改成功！',U('notice/index'));
        }else{
            $this->error('公告修改失败！',U('notice/index'));
        }

    }
    
}
