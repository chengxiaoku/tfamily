<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;
use Common\Util;

/**
 * 楼盘管理控制器
 * Class IndexController
 * @package Admin\Controller
 * @author CLF 710425820@qq.com
 * @date 2016-11-11
 */
class HouseController extends BaseController
{

    /**
     * 楼盘列表
     */
    public function index()
    {
        //初始化
        session('house_sec', null);
        $this->assign('page_title', '楼盘列表');
        $User = M('house');
        //每页显示数量
        $num = C('PAGE_SIZE');
        $count = $User->count();
        //每页数据数
        $Page = new Util\MyPage($count, $num);
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();
        // 赋值数据集
        $this->assign('data', $list);
        // 赋值分页输出
        $this->assign('page', $show);
        //建筑类型
        $lp_type = C('lp_type');
        $arr_new = array();
        foreach ($list as $val) {
            $arr_new [] = $lp_type[$val['jzlx']];
        }
        $this->assign('arr_new', $arr_new);
        $this->display();
    }

    /**
     * 搜索分页
     */
    public function indel_sel()
    {
        $this->assign('page_title', '楼盘列表');
        $User = M('house');
        $num = C('PAGE_SIZE');
        $sec = $_POST['sec'];
        if (!empty($sec)) {
            session('house_sec', $sec);
        }
        $sec = empty($sec) ? session('house_sec') : $sec;

        $where['title'] = array('like', '%' . $sec . '%');
        $count = $User->where($where)->count();
        $Page = new Util\MyPage($count, $num);
        $list = $User->where($where)->order('id desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');

        $show = $Page->show();
        // 赋值数据集
        $this->assign('data', $list);
        // 赋值分页输出
        $this->assign('page', $show);
        //建筑类型
        $lp_type = C('lp_type');
        $arr_new = array();
        foreach ($list as $val) {
            $arr_new [] = $lp_type[$val['jzlx']];
        }
        $this->assign('arr_new', $arr_new);
        $this->display('index');
    }


    /**
     * 楼盘信息修改页面展示
     */
    public function house_update()
    {
        $this->assign('page_title', '修改楼盘信息');
        $upda_id = I('get.update_id', '');
        if (empty($upda_id)) {
            $this->error("缺少参数!", U('house/index'));
            exit();
        }
        $data = M('house')->where("id=$upda_id")->select();
        $this->assign('data', $data);
        //获取户型信息
        $hx_data = M('house_type')->where("house_id=$upda_id")->select();
        $this->assign('hx_data', $hx_data);
        //楼盘相册

        $img_arr = unserialize($data[0]['images']);
        $this->assign('img_arr', $img_arr);

        //建筑类型
        $lp_type = C('lp_type');
        $this->assign('lp_type', $lp_type);
        //物业类型
        $wy_type = C('wy_type');
        $this->assign('wy_type', $wy_type);
        $this->display();
    }

    /**
     *修改数据的入库
     */
    function house_update_sql()
    {
        //true 标示修改
        $this->add_house_sql(true);
    }

    /**
     * 添加楼盘
     */
    public function add_house()
    {
        $this->assign('page_title', '添加楼盘');
        //建筑类型
        $lp_type = C('lp_type');
        $this->assign('lp_type', $lp_type);
        //物业类型
        $wy_type = C('wy_type');
        $this->assign('wy_type', $wy_type);
        $this->display();
    }

    /**
     * 楼盘数据的添加或修改
     * @param bool $re true 为修改  false 为添加
     */
    public function add_house_sql($retur = false)
    {
        header('Content-type:text/html;charset=utf-8');
        $data['title'] = I('post.house_name');
        //是否推荐
        $data['is_recommended'] = I('post.is_recommended');
        //是否热门
        $data['is_hot'] = I('post.is_hot');
        //状态
        $data['is_sale'] = I('post.is_sale');
        //最大面积
        $data['max_area'] = I('post.max_area');
        //最小面积
        $data['min_area'] = I('post.min_area');
        //促销信息
        $data['promotion_msg'] = I('post.promotion_msg');
        //楼盘简介
        $data['summary'] = I('post.house_mess');
        //物业类型
        $data['property_type'] = I('post.house_type');
        //参考价格
        $data['price'] = I('post.house_money');
        //项目特色
        $data['feature'] = I('post.ts');
        //区域(省)
        $data['province_id'] = I('post.province_id');
        //区域(市)
        $data['city_id'] = I('post.city_id');
        //区域(县，区)
        $data['district_id'] = I('post.district_id');
        //楼盘地址
        $data['address'] = I('post.house_adress');
        //售楼地址
        $data['sale_address'] = I('post.sl_adress');
        //开发商
        $data['builder_company'] = I('post.developer');
        //楼盘缩略图
        $data['thumb'] = I('post.jb_image');
        //添加时间
        $data['add_time'] = date('Y-m-d H:i:s',time());;
        //楼盘相册
        $arr_lp = I('post.lp_thumb');
        $lp_text = I('post.lp_text');
        $arr_lp_num = count($arr_lp);
        $arr_new = array();
        $sum = $arr_lp_num / 4;

        for ($i = 1; $i < $sum; $i++) {
            $arr_new [] = array('title' => $lp_text[$i], 'images' => array($arr_lp[$i * 4], $arr_lp[$i * 4 + 1], $arr_lp[$i * 4 + 2], $arr_lp[$i * 4 + 3]));
        }
        $str = serialize($arr_new);
        $data['images'] = $str;
        //建筑类型
        $data['jzlx'] = I('post.jz_type');

        //最新开盘
        $da = date('Y-m-d',time());
        $_time = I('post.zj','','trim');
        if(empty($_time)){
            $_time = $da;
        }

        $data['open_time'] = $_time;
        //物业类型
        $data['property_type'] = I('post.lx');
        //产权年限
        $data['cqnx'] = I('post.cq');
        //省
        $data['province_id'] = I('post.province_id');
        //市
        $data['city_id'] = I('post.city_id');
        //区
        $data['district_id'] = I('post.district_id');
        //指定成功或者错误跳转的路径
        $url = U('house/index');
        if ($retur) {
            //'修改操作';
            //修改数据的ID
            $up_id = I('post.up_id');
            M('house')->where("id=$up_id")->save($data);
        } else {
            //'增加操作';
            $re = M('house')->add($data);
            if (!$re) {
                $this->error("数据添加失败!", $url);
                exit();
            }
            //返回刚插入数据的ID
            $last_id = M('house')->getLastInsID();
        }

        //添加户型操作
        //户型名称
        $hx = I('post.hx');
        //户型朝向
        $hx_cx = I('post.hx_cx');
        //居室（室）
        $hx_type_s = I('post.hx_type_s');
        //居室（厅）
        $hx_type_t = I('post.hx_type_t');
        //居室(卫)
        $hx_type_w = I('post.hx_type_w');
        //建筑面积
        $hx_mj = I('post.hx_mj');
        //户型缩略图
        $thumb = I('post.thumb');
        //连接户型数据库
        $hx_link = M('house_type');
        //计算数据条数
        $re1 = true;
        $hx_num = count($hx);
        if ($retur) {
            //清空之前所有户型 再添加
            $hx_link->where("house_id=$up_id")->delete();
        }
        for ($i = 1; $i < $hx_num; $i++) {

            $data_hx['title'] = $hx[$i];
            $data_hx['thumb'] = $thumb[$i];
            $data_hx['room'] = $hx_type_s[$i];
            $data_hx['hall'] = $hx_type_t[$i];
            $data_hx['toilet'] = $hx_type_w[$i];
            $data_hx['orientation'] = $hx_cx[$i];
            $data_hx['area'] = $hx_mj[$i];

            if ($retur) {
                //'修改操作';
                $data_hx['house_id'] = $up_id;
                $a = $hx_link->add($data_hx);
                if (!$a) {
                    $re1 = false;
                }
            } else {
                //'增加操作';
                $data_hx['house_id'] = $last_id;
                $a = $hx_link->add($data_hx);
                if (!$a) {
                    $re1 = false;
                }
            }
        }


        if ($retur) {
            //'修改操作';
            if (!$re1) {
                $this->error("数据修改失败!", $url);
                exit();
            } else {
                $this->success("数据修改成功", $url);
                exit();
            }
        } else {
            //'增加操作';
            if (!$re1) {
                $this->error("数据添加失败!", $url);
                exit();
            } else {
                $this->success("数据添加成功", $url);
                exit();
            }
        }
    }

    /**
     * 楼盘数据删除(数据库操作)
     */
    public function house_del($del_id)
    {

        $model = M("house");
        $data['id'] = array('in', $del_id);
        $rs = $model->where($data)->delete();
        
        //删除户型表中对应数据
        $data1['house_id'] = array('in', $del_id);
        M('house_type')->where($data1)->delete();

        $url = U("house/index");
        if ($rs !== false) {
            $this->success("数据删除成功", $url);
        } else {
            $this->error("数据删除失败", $url);
        }
    }
}