<?php
namespace App\Model;
use Think\Model;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/11
 * Time: 21:34
 */
class AdminModel extends Model{
    protected $tableName    = 'admin';
    protected $patchValidate =true;
    protected $pk           = 'id';
    protected $_validate = array(
        array('name','require','用户名不能为空!'),
    );

}