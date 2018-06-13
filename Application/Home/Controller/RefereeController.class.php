<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 用户推广页面
 * Created by PhpStorm.
 * User: hdj
 * Date: 2016/11/22
 * Time: 11:26
 */
class RefereeController extends Controller {
    /**
     * 控制器初始化
     */
    public function _initialize() {
        //定义资源目录
        define('ASSETS', './Public/assets/');
    }

    /**
     * 注册页
     */
    public function index() {
        if (IS_POST) {
            $tel = isset($_POST['tel']) ? trim($_POST['tel']) : "";
            $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : "";
            $password = isset($_POST['password']) ? trim($_POST['password']) : "";
            $password1 = isset($_POST['password1']) ? trim($_POST['password1']) : "";
            $province_id = isset($_POST['province_id']) ? $_POST['province_id'] : "";
            $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : "";
            $district_id = isset($_POST['district_id']) ? $_POST['district_id'] : "";
            $ref = isset($_POST['ref_id']) ? $_POST['ref_id'] : 0;

            if (empty($tel)) {
                $this->assign("error", "手机号码不能为空");
                $this->dispay();
                exit;
            }
            if (empty($nickname)) {
                $this->assign("error", "昵称不能为空");
                $this->dispay();
                exit;
            }
            if (empty($password)) {
                $this->assign("error", "密码不能为空");
                $this->dispay();
                exit;
            }
            if ( $password != $password1) {
                $this->assign("error", "两次输入不一致");
                $this->dispay();
                exit;
            }

            // 入库
            $db = M("user");
            //检测电话号码是否存在
            $has = $db->where(array("tel"=>$tel))->find();
            if ($has) {
                $this->assign("error", "该电话号码已注册");
                $this->dispay();
                exit;
            }

            $remark = '通过推荐方式注册';
            $data = array(
                'name' => $tel,
                'pwd' => md5($password),
                'tel' => $tel,
                'province_id' => $province_id,
                'city_id' => $city_id,
                'district_id' => $district_id,
                'user_type' => 'member',
                'parentid' => $ref,
                'status' => 'enabled',
                'is_validated' => 'pending',
                'add_time' => date("Y-m-d H:i:s"),
                'money' => 0,
                'integral' => 0,
                'remark' => $remark
            );
            $bool = $db->data($data)->add();
            if ($bool) {
                if ($this->isMobile()) {
                    $goto_url = U("weixin/index/index");
                } else {
                    $goto_url = U("home/index/index");
                }

                $this->success("恭喜您注册成功，等待平台审核", $goto_url);
            } else {
                $this->assign("error", "注册失败，请联系平台管理员");
                $this->dispay();
                exit;
            }


        } else {
            $use_id=isset($_GET['ref'])?$_GET['ref']:'';
            $this->assign("user",$use_id);
            $this->display();
        }


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


      public function q() {
        $tel=$_GET['tel'];
        $tf_user=M('user');
        $data_user=$tf_user->select();
        foreach ($data_user as $u){
            if ($u['tel']==$tel){
                echo json_encode('重复');
                exit;
            }
        }
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
}