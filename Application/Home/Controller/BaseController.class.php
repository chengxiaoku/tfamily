<?php
namespace Home\Controller;
use Think\Controller;
use Common\Util\UploadHandler;


/**
 * 网站首页控制器基类
 * Created by PhpStorm.
 * User: 王俊璐
 * Date: 2016/11/21
 * Time: 11:11
 */
class BaseController extends Controller
{

    /**
     * 检测客户端是否是移动端
     */
    public function isMobile() {
        //导入平台检测类
        import("Common.Vendor.Mobile_Detect", APP_PATH, '.php');
        $detect = new \Mobile_Detect();
        return $detect->isMobile();
    }

    /**
     * 控制器初始化
     */
    protected function _initialize()
    {
        if ($this->isMobile()) {
            $weixin_url = "http://www.tjy518.com/weixin.php";
            redirect($weixin_url);
        }
        //定义资源目录
        define('HOUSE', './Public/house/');
	    define('ASSETS', './Public/assets/');
        //判断网站状态,获取网站相关信息
        $option = M('options');
        $status = $option->where("`key` = 'site_status'")->field('value')->select();
        $reason = $option->where("`key` = 'close_reason'")->field('value')->select();
        $status = isset($status[0]['value'])?$status[0]['value']:1;
        $reason = $reason[0]['value'];

        $site_keywords = $option->where("`key` = 'site_keywords'")->field('value')->select();
        $site_description = $option->where("`key` = 'site_description'")->field('value')->select();
        $site_keywords = $site_keywords[0]['value'];
        $site_description = $site_description[0]['value'];
        session('site_keywords',$site_keywords);
        session('site_description',$site_description);

        if ($status == 0) {
            $this->assign('page_title','T家园创业平台');
            $this->assign('because',$reason);
            $this->display("Public/close_site");
            exit();
        }

        if(cookie('city_id')==''){
            cookie('city_id',189);
        }

    }

    /**
     * 获取属性值
     * @param unknown $property
     * @param string $default
     */
    public function getVar($property, $default = null)
    {
        if (isset($this->$property)) {
            return $this->$property;
        }
        return $default;
    }

    /**
     * 设置属性值
     * @param unknown $property
     * @param string $value
     * @return mixed $previous value
     */
    public function setVar($property, $value = null)
    {
        $previous = isset($this->$property) ? $this->$property : null;
        $this->$property = $value;
        return $previous;
    }

    /**
     * 文件上传-调用TP自带的文件上传类
     * @link http://www.kancloud.cn/manual/thinkphp/1876
     */
    public function upload()
    {
        //$save_path = ROOT_PATH . 'Public/upload/';
        $config = array(
            'maxSize' => 3145728,
            'rootPath' => ROOT_PATH . 'Public/',
            'savePath' => 'upload/',
            'saveName' => 'uniqid',
            'exts' => array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub' => true,
            'subName' => array('date', 'Ymd'),
        );
        $upload = new \Think\Upload($config);
        //返回数据格式
        $data = array(
            'error' => 0,
            'url' => '',
            'message' => 'aa'
        );
        // 上传文件
        $info = $upload->upload();
        if (!$info) {
            $error = $upload->getError();
            $data['error'] = 1;
            $data['message'] = $error;
        } else {
            foreach ($info as $file) {
                // code here
            }
        }
        echo json_encode($data);
    }

    /**
     * 文件上传类-页面使用jquery file upload 插件
     * @see https://github.com/blueimp/jQuery-File-Upload/
     */
    public function jqueryFileUpload()
    {
        $sub_dir = date("Ymd", time());
        $save_path = ROOT_PATH . 'Public/upload/' . $sub_dir . '/';
        $upload_url = ROOT_PATH . 'Public/upload/' . $sub_dir . '/';
        $file_name = generate_random_string(16);
        $options = array(
            'file_name' => $file_name,
            'upload_dir' => $save_path,
            'upload_url' => $upload_url,
            'image_versions' => array(
                'thumbnail' => array('max_width' => 200, 'max_height' => 200)
            )
        );
        new UploadHandler($options);
    }

    /**
     * 获取城市信息（省市区三级联动）
     */
    public function getCity()
    {
        $model = M("region");
        $data = $model->select();
        $this->responseJSON($data);
    }

    /**
     * 返回JSON字符
     * @param $data
     */
    private function responseJSON($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}