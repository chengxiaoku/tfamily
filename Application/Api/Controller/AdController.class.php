<?php
namespace Api\Controller;
use Api\Controller\BaseController;
use Think\View;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 11:09
 */
class AdController extends BaseController {

    /**
     * 根据广告位获取广告
     * @param $id
     */
    public function render($id) {
        // 确定类型
        if (empty($id)) {
            exit;
        }
        $ad_space_data = M("adspace")->where("id=$id")->find();
        if ($ad_space_data) {
            $type = $ad_space_data['type'];
            $content = $this->get_content($id, $type);
            echo $content;
        } else {
            echo "非法请求";
        }

    }

    /**
     * @param $space_id
     * @param $ad_type
     */
    private function get_content($space_id, $ad_type) {
        if (empty($space_id)) {
            exit;
        }
        $where = array(
            'space_id' => $space_id
        );
        $data = M("ads")->where($where)->select();
        $rows = array();
        foreach ($data as $row) {
            $begin_time = $row['start_time'];
            $begin_time = strtotime($begin_time);
            $end_time = $row['end_time'];
            $end_time = strtotime($end_time);
            $now_time = time();
            if($now_time >$begin_time & $now_time<$end_time){
                $_row = unserialize($row['ad_content']);
                $rows[] = $_row;
            }
        }
        $content = json_encode($rows);
        $view = new View();
        $view->assign('id', $space_id);
        $view->assign('content', $content);
        return $view->fetch("$ad_type");
    }

}