<?php
namespace Agent\Controller;

use Agent\Controller\BaseController;
use Common\Util;

/**
 * 我的消息控制器
 * Class IndexController
 * @package Agent\Controller
 * @author xxx@qq.com
 * @date 2016-11-11
 */
class NoticesController extends BaseController
{

    public function index()
    {
        $user = $this->getUser();
        $user_id = $user['id'];
        $province_id = $user['province_id'];
        $city_id = $user['city_id'];
        $district_id = $user['district_id'];
        $db = M('notices');
        $p = trim(isset($_GET['p'])?$_GET['p']:"1");


        //$count = $db->where($map)->count();
       $count="SELECT COUNT(*) AS tp_count FROM `tf_notices` WHERE ( type = 'one' and userid = $user_id )
OR type='all' 
OR ( type = 'range' and province_id = $province_id AND city_id = 0 AND district_id = 0 ) 
OR ( type = 'range' and province_id = $province_id AND city_id = $city_id and district_id = 0 ) 
OR ( type = 'range'  and province_id = $province_id AND city_id = $city_id and district_id = $district_id)
   ";
        $count = $db->query($count);
        $count = $count[0]['tp_count'];
        $page_size = C("PAGE_SIZE");
        $page = new Util\MyPage($count, $page_size);
        $offset = ($p-1)*$page_size;
       // $data = $db->where($map)->order('add_time desc')->page($p. ',' . $page_size)->select();
        $data ="SELECT * FROM `tf_notices` WHERE ( type = 'one' and userid = $user_id )
OR type='all' 
OR ( type = 'range' and province_id = $province_id AND city_id = 0 AND district_id = 0 ) 
OR ( type = 'range' and province_id = $province_id AND city_id = $city_id and district_id = 0 ) 
OR ( type = 'range'  and province_id = $province_id AND city_id =$city_id and district_id = $district_id)
 ORDER BY add_time desc LIMIT $offset,$page_size";
       
        
        $data =$db->query($data);

        $page = $page->show();
        //显示未读消息

        /*echo $db->getLastSql();
        exit;*/


        $this->assign("notices", $data);
        $this->assign("page", $page);
        $this->assign("page_title", "我的消息");
        $this->display();


    }
    /*
     * 异步
     */
    public function model()
    {
        //$id = trim(isset($_POST['id']) ? $_POST['id'] : "");
        $id = $_GET['id'];
        $db = M("notices");
        $data = $db->where("id = $id")->find();
       /* $condition['userid'] = 1;
        $condition['type'] = 'all';
        $condition['_logic'] = 'or';
        $map['_complex'] = $condition;
        $map['view'] = 0;
        $map['_logic'] = 'and';
        $num = $db->where($map)->count();
        $data['num'] = $num-1;*/

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

