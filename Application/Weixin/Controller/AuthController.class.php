<?php
namespace Weixin\Controller;
use Weixin\Controller\BaseController;

class AuthController extends BaseController {
    public function login() {
        $agent = session('user_id');
        $member = session('_member_user_id');
        if ($agent != '') {
            echo "<script>
                location.href='./agent.php';
            </script>";
        } else if ($member != '') {
            echo "<script>
                location.href='./member.php';
            </script>";
        } else {
            $this->display();
        }

    }
}