<?php
namespace Member\Controller;
use Member\Controller\BaseController;
/**
 * Created by PhpStorm.
 * User: think
 * Date: 2016/11/16
 * Time: 19:07
 */
class RefereeController extends BaseController {

    /**
     * 首页
     */
    public function twoma(){
        import('Common.Vendor.phpqrcode.phpqrcode',APP_PATH, '.php');
        $user=$this->getUser();
        $id=$user['id'];
        $qian=$_SERVER['HTTP_HOST'];
        $url='http://'.$qian.'/TFamily/index.php?m=Agent&c=referee&a=index&ref='.$id;
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "10"; // 点的大小：1到10
        \QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);
    }
    public function index() {
        $user=$this->getUser();
        $id=$user['id'];
        $qian=$_SERVER['HTTP_HOST'];
        $this->assign("url", 'http://'.$qian.'/TFamily/index.php?m=Agent&c=referee&a=index&ref='.$id);
        $this->assign("page_title", "我要推广");
        $this->display();
    }

}