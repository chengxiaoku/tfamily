<?php
namespace Weixin\Controller;
use Think\Controller;
use Common\Util\UploadHandler;

/**
 * 控制器基类
 * Created by PhpStorm.
 * User: 署名
 * Date: 2016/11/9
 * Time: 21:50
 * Description: 描述
 */
class BaseController extends Controller {

    /**
     * 控制器初始化
     */
    protected function _initialize() {
        //定义资源目录
        define('ASSETS', './Public/assets/');
        define('WEIXIN_ASSETS','./Public/weixin_assets/');
    }

    /**
     * 获取属性值
     * @param unknown $property
     * @param string $default
     */
    public function getVar($property, $default = null) {
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
    public function setVar($property, $value = null) {
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
        $config = array (
            'maxSize'    =>    3145728,
            'rootPath'   =>    ROOT_PATH . 'Public/',
            'savePath'   =>    'upload/',
            'saveName'   =>    'uniqid',
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
        $upload = new \Think\Upload($config);
        //返回数据格式
        $data = array(
            'error' => 0,
            'url' => '',
            'message' => 'aa'
        );
        // 上传文件
        $info  =   $upload->upload();
        if (!$info) {
            $error = $upload->getError();
            $data['error'] = 1;
            $data['message'] = $error;
        } else {
            foreach($info as $file){
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
        $save_path =  ROOT_PATH . 'Public/upload/' . $sub_dir . '/';
        $site_url = C('SITE_URL');
        $upload_url = rtrim($site_url, '/') . '/Public/upload/' . $sub_dir . '/';
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
    public function getCity() {
        $model = M("region");
        $data = $model->select();
        $this->responseJSON($data);
    }

    /**
     * 返回JSON字符
     * @param $data
     */
    private function responseJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
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
     * 获取用户信息
     */
    public function getUser() {
        $user = array(
            'id' => '',
            'name' => '',
            'role_id' => '',
            'last_ip' => '',
            'last_time' => '',
            'realname' => ''
        );
        return $user;
    }
}
