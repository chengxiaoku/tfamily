<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/29
 * Time: 10:29
 */
class TestController extends BaseController{

    public function index(){
        header('Content-type:text/html;charset=utf-8');
        /*
        //批量增加数据
        $datall = array(
            array(
                'title' =>'楼盘名',
                'summary' =>'简介',
            ),
            array(
                'title' =>'楼盘名',
                'summary' =>'简介',
            ),
            array(
                'title' =>'哈哈哈',
                'summary' =>'简介',
            ),
        );
        M('house')->addAll($datall);
        $data1 = M('house')->select();
        dump($data1);
        */
        //按条件查询
        $where['id'] = array(
            'gt',70,
        );
        $where['summary'] = '简介';
        $where['_logic'] = 'or';
        $data = M('house')->where($where)->select();
        dump($data);
        //多条件排序
        M('house')->order("id desc,sroce asc")->select();
        echo M()->getLastSql();
        //多表查询
        //用JOIN  连接  inner  join   自连接
        M('house')->join('Right join tf_house_type On tf_house.id=tf_house.id')->select();
    }
}
