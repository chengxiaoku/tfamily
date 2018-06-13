<?php
namespace Api\Controller;
use Api\Controller\BaseController;
/**
 * 微信接口
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/25
 * Time: 11:19
 */
class WeixinController extends BaseController {

    private $token = 'tfamily';

    public function index() {
        //http://tjy518.com/api.php?c=weixin&a=index
        if (IS_GET) {
            $this->valid();
        } else {
            $this->responseMsg();
        }
    }

    public function responseMsg() {

    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    private function checkSignature()
    {
        // you must define TOKEN by yourself
        /*if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }*/
        $token = $this->token;
        if (!$token) {
            throw new Exception('TOKEN is not defined!');
        }
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];


        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }


}
