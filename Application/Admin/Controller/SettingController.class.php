<?php
namespace Admin\Controller;

use Admin\Controller\BaseController;
use Think\Model;

/*
 * 基础设置控制器
 * Created by Phpstorm
 * User:易子钦
 * Date:2016/11/10
 * Time:12:00
 * Description:基础设置三个页面的控制器
 */

class SettingController extends BaseController {
    /*
     * 团队级别列表
     */
    public function team() {
        $tf_level = M("level");
        $data = $tf_level->select();
        $this->assign("list", $data);
        $this->assign("page_title", "会员等级");
        $this->display();
    }
    /*
     * 团队级别添加
     */
    public function team_lv_add() {
        $id = I("get.id");
        if ($id) {
            $level = M("level");
            $data = $level->where("id=$id")->find();
            $this->assign('lists', $data);
        }
        if (IS_POST) {
            $data = array(
                "name" => I('post.name'),
                "award_integral" => I('post.award_integral'),
                "year_salary" => I('post.year_salary'),
                "award_fans" => I('post.award_fans'),
                "award_direct" => I('post.award_direct'),
                "award_team" => I('post.award_team'),
                "award_year" => I('post.award_year'),
                "teams" => I('post.teams'),
                "description" => I('post.description')
            );
            $level = M("level");
            $result = $level->add($data);
            if (!$result) {
                $this->error("添加失败", U('Setting/team'));
            } else {
                $this->success("添加成功", U('Setting/team'));
            }
        } else {
            $this->assign("page_title", "会员级别添加");
            $this->display();
        }
    }
    /*
     * 团队级别编辑
     */
    public function team_lv_upd() {
        if (IS_POST) {
            $id = I('post.id');
            $data = array(
                "name" => I('post.name'),
                "award_integral" => I('post.award_integral'),
                "year_salary" => I('post.year_salary'),
                "award_fans" => I('post.award_fans'),
                "award_direct" => I('post.award_direct'),
                "award_team" => I('post.award_team'),
                "award_year" => I('post.award_year'),
                "teams" => I('post.teams'),
                "description" => I('post.description')
            );
            $level = M("level");
            $result = $level->where("id=$id")->save($data);
            if (!$result) {
                $this->error("修改失败", U('Setting/team'));
            } else {
                $this->success("修改成功", U('Setting/team'));
            }
        } else {
            $this->error("页面不存在", U('Setting/team'));
        }
    }
    /*
     * 团队级别删除
     */
    public function team_lv_del() {
        $id = I('get.id');
        $level = M('level');
        $result = $level->where("id=$id")->delete();
        if (!$result) {
            $this->error("删除失败", U('Setting/team'));
        } else {
            $this->success("删除成功", U('Setting/team'));
        }
    }
    /*
     * 参数设置表单与保存
     */
    public function option() {
        //将值抛到前端显示
        $options = M('options');
        $data = $options->select();
        $new_array = array();
        foreach ($data as $key => $val) {
            $new_array[$val['key']] = $val['value'];
        }
        if (!empty($new_array)) {
            $this->assign("value",$new_array);
        }
        //值的添加与更改
        if (IS_POST) {
            $obj = M('options');
            $data = I('post.');
            $_data = $obj->select();
            if (empty($_data)) {
                foreach ($data as $key => $val) {
                    $sql = "insert into tf_options (`key`,`value`) VALUES ('$key','$val')";
                    $obj->execute($sql);
                }
            } else {
                $upd_option = M();
                foreach ($data as $key => $value) {
                    $i = 0;
                    foreach ($_data as $k=>$v) {
                        if ($key == $v['key']) {
                            $sql = "update tf_options set `value`='$value' where `key`='$key'";
                            $upd_option->execute($sql);
                        } else {
                            $i++;
                            if ($i == count($_data)) {
                                $sql = "insert into tf_options (`key`,`value`) VALUES ('$key','$value')";
                                $upd_option->execute($sql);
                            }
                        }
                    }
                }
            }
            $this->success("保存成功", U('Setting/option'));
        } else {
            $this->assign("page_title", "参数设置");
            $this->display();
        }
    }
    /*
     * 网站设置表单
     */
    public function site() {
        $options = M('options');
        $datas = $options->select();
        $new_array = array();
        foreach ($datas as $key => $val) {
            $new_array[$val['key']] = $val['value'];
        }
        $this->assign('lists', $new_array);
        $this->assign("page_title", "网站设置");
        $this->display();
    }
    /*
     * 网站设置保存
     */
    public function site_form() {
        if (IS_POST) {
            $obj = M('options');
            $data = I('post.');
            $_data = $obj->select();
            if (empty($_data)) {
                foreach ($data as $key => $val) {
                    $sql = "insert into tf_options (`key`,`value`) VALUES ('$key','$val')";
                    $obj->execute($sql);
                }
            } else {
               $upd_site = M();
               foreach ($data as $key => $value) {
                   $i = 0;
                   foreach ($_data as $k=>$v) {
                       if ($key == $v['key']) {
                           $sql = "update tf_options set `value`='$value' where `key`='$key'";
                           $upd_site->execute($sql);
                       } else {
                           $i++;
                           if ($i == count($_data)) {
                               $sql = "insert into tf_options (`key`,`value`) VALUES ('$key','$value')";
                               $upd_site->execute($sql);
                           }
                       }
                   }
               }
            }
            $this->success("保存成功", U('Setting/site'));
        } else {
            $this->error("页面不存在", U('Setting/site'));
        }

    }
}