<?php
namespace Agent\Controller;
use Agent\Controller\BaseController;

/**
 * 我要推广控制器
 * Class RefereeController
 * @package Agent\Controller
 * @author qxx 2315400689@qq.com
 * Date: 2016/11/16/016
 * Time: 18:45
 */
class RefereeController extends BaseController{
    public function code(){
        import('Common.Vendor.phpqrcode.phpqrcode',APP_PATH,'.php');
        $user=$this->getUser();
        $id=$user['id'];
        $qian=$_SERVER['HTTP_HOST'];
        $value='http://'.$qian.'/index.php?m=home&c=referee&a=index&ref='.$id;
        $errorCorrectionLevel = "L"; // 纠错级别：L、M、Q、H
        $matrixPointSize = "6"; // 点的大小：1到10
        \QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);
        
    }

    public function index(){

        $user=$this->getUser();
        $id=$user['id'];
        $qian=$_SERVER['HTTP_HOST'];
        $this->assign("url", 'http://'.$qian.'/index.php?m=home&c=referee&a=index&ref='.$id);

        $this->assign("page_title", "我要推广");

        $this->display();
    }
}