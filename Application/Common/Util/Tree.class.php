<?php
/**
 * Created by PhpStorm.
 * User: dyy
 * Date: 2016/11/17
 * Time: 9:32
 * 分类树
 */
namespace Common\Util;
class Tree
{

    public $data = array();
    public $ret = array();

    public function __construct($arr)
    {
        $this->data = $arr;
    }

    public function get_descendant($id)
    {
        $arr = $this->data;
        foreach ($arr as $key => $val) {
            if ($val['parentid'] == $id) {
                $this->ret[$key] = $val;
                $this->get_descendant($val['id']);
            }
        }
        return $this->ret;
    }
}