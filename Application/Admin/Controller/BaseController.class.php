<?php
namespace Admin\Controller;
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

        //获取上一次访问的地址
        $redirect_url = $_SERVER['HTTP_REFERER'];
        session('redirect_url', $redirect_url);

        //检测会话是否过期
        $now = time();
        $expire = session('expire');
        if (is_null($expire)) {
            $expire = 0;
        }
        if ($now > $expire) {
            session_destroy();
            session('redirect_url', $redirect_url);
            $url = U('auth/login');
            redirect($url);
            exit;
        }

        //检测是否登录
        $user_id = session('_admin_user_id');
        if (empty($user_id)) {
            session('redirect_url', $_SERVER['REQUEST_URI']);
            $url = U('auth/login');
            redirect($url);
        }

        //获取菜单
        $menu = $this->buildMenu();
        $this->assign("menu_html", $menu);

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
     * 空操作
     */
    public function _empty(){
        header('Content-type:text/html;charset=utf-8');
        echo '输入了没有的方法!';
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
     * 构建菜单
     */
    protected function buildMenu() {
        $menu = C("MENU");
        $li = '';
        foreach ($menu as $k => $item) {
            //检查权限
            if (!$this->accessMenuItem($item)) {
                continue;
            }
            $child_menu = $this->getMenuItemChildren($item);
            $li .= '<li class="'.$this->getMenuItemClass($item).'">';
            if ($item['children']) {
                $li .= '<a href="'.$this->getMenuItemLink($item).'"><i class="'.$item['icon'].'"></i> <span>'.$item['title'].'</span><i class="fa fa-angle-left pull-right"></i></a>';
            } else {
                $li .= '<a href="'.$this->getMenuItemLink($item).'"><i class="'.$item['icon'].'"></i> <span>'.$item['title'].'</span></a>';
            }
            $li .= $child_menu;
            $li .= '</li>';
        }
        return $li;
    }

    /**
     * 获取子菜单项
     * @param $parent
     */
    protected function getMenuItemChildren($parent) {
        $html = '';
        $children = $parent['children'];
        if ($children) {
            $html = '<ul class="treeview-menu">';
            foreach ($children as $k => $item) {
                $html .= '<li class="'.$this->getMenuItemClass($item, false).'">';
                $html .= '<a href="'.$this->getMenuItemLink($item).'"><i class="fa fa-circle-o"></i> <span>'.$item['title'].'</span></a>';
                $html .= '</li>';
            }
            $html .= '</ul>';
        }
        return $html;
    }

    /**
     * 获取菜单项样式
     * @param $item
     * @param bool $parent
     * @return string
     */
    protected function getMenuItemClass($item, $parent = true) {
        $css_class = 'treeview';
        //active
        if ($parent) {
            $children = $item['children'];
            $actived = false;
            if ($children) {
                foreach ($children as $child) {
                    if (
                        strtolower($child['c']) == strtolower(CONTROLLER_NAME)
                        && strtolower($child['a']) == strtolower(ACTION_NAME)
                        && strtolower($child['m']) == strtolower(MODULE_NAME)
                    ) {
                        $actived = true;
                        break;
                    }
                }
            } else {
                if (
                    strtolower($item['c']) == strtolower(CONTROLLER_NAME)
                    && strtolower($item['a']) == strtolower(ACTION_NAME)
                    && strtolower($item['m']) == strtolower(MODULE_NAME)
                ) {
                    $actived = true;
                }
            }

            if ($actived) {
                $css_class .= ' active';
            }
        } else {
            if (
                strtolower($item['c']) == strtolower(CONTROLLER_NAME)
                && strtolower($item['a']) == strtolower(ACTION_NAME) 
                && strtolower($item['m']) == strtolower(MODULE_NAME)
            ) {
                $css_class .= ' active';
            }
        }

        return $css_class;
    }

    /**
     * 获取菜单连接
     * @param unknown $item
     * @return string
     */
    protected function getMenuItemLink($item) {
        $m = $item['m'];
        $c = $item['c'];
        $a = $item['a'];
        $route = $m . '/' . $c . '/' . $a;
        return U($route);
    }

    /**
     * 检测是否有权限访问该菜单项
     * @param $item
     * @return boolean
     */
    protected function accessMenuItem($item) {
        static $rights;
        //判断是不是超级管理员
        $is_super_admin = session('_admin_is_super_admin');
        if ($is_super_admin) {
            return true;
        }

        if (!isset($rights)) {
            //$user = $this->getUser();
            //$role_id = $user['role_id'];
            $role_id = session('_admin_role_id');
            $rights = $this->getRights($role_id);
        }

        $m = $item['m'];
        $c = $item['c'];
        $a = $item['a'];
        $actions = $item['actions'];
        if (!empty($actions)) {
            $actions = explode(',', $actions);
        } else {
    	    $actions = array();
	}

        $result = false;
        foreach ($rights as $r) {
            $route = explode('|', $r);
            if (count($route) == 2 && $m == $route[0] && $c == $route[1]) {
                $result = true;
                break;
            }

            if (count($route) == 3 && $m == $route[0] && $c == $route[1] && $a == $route[2]) {
                $result = true;
                break;
            }

            if (count($route) == 3 && $m == $route[0] && $c == $route[1] && in_array($a, $actions)) {
                $result = true;
                break;
            }

        }
        return $result;
    }

    /**
     * 根据角色ID获取权限
     * @param $role_id
     * @return $data
     */
    protected function getRights($role_id) {
        if (empty($role_id)) {
            return null;
        }
        $model = M("admin_role");
        $data = $model->where(array('id'=>$role_id))->getField("rights");
        $data = unserialize($data);
        return $data;
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
