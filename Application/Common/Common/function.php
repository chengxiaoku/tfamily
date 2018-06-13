<?php
/**
 * 公共函数库
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/9
 * Time: 22:57
 */


/**
 * 生成随机数
 * @param int $length
 * @return string
 */
function generate_random_string($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	//+-*#&@!?
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



/**
 * 获取请求ip
 *
 * @return ip地址
 */
function get_ip() {
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
}

/**
 * 检测数据是否被序列化、
 *
 * @see http://stackoverflow.com/a/4994628
 * @param $data
 * @return bool
 */
function is_serialized( $data ) {
    // if it isn't a string, it isn't serialized
    if ( !is_string( $data ) )
        return false;
    $data = trim( $data );
    if ( 'N;' == $data )
        return true;
    if ( !preg_match( '/^([adObis]):/', $data, $badions ) )
        return false;
    switch ( $badions[1] ) {
        case 'a' :
        case 'O' :
        case 's' :
            if ( preg_match( "/^{$badions[1]}:[0-9]+:.*[;}]\$/s", $data ) )
                return true;
            break;
        case 'b' :
        case 'i' :
        case 'd' :
            if ( preg_match( "/^{$badions[1]}:[0-9.E-]+;\$/", $data ) )
                return true;
            break;
    }
    return false;
}

/**
 * 生成唯一ID
 *
 * @param int $length
 * @return string
 */
function create_guid($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';	//+-*#&@!?
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * 截取字符串
 * @param unknown $str
 * @param number $start
 * @param unknown $length
 * @param string $charset
 * @param string $suffix
 * @return string|unknown
 */
function my_substr($str, $start = 0, $length, $charset = "utf-8", $suffix = true) {
    if (function_exists ( "mb_substr" )) {
        if ($suffix && strlen ( $str ) > $length)
            return mb_substr ( $str, $start, $length, $charset ) . "...";
        else
            return mb_substr ( $str, $start, $length, $charset );
    } elseif (function_exists ( 'iconv_substr' )) {
        if ($suffix && strlen ( $str ) > $length)
            return iconv_substr ( $str, $start, $length, $charset ) . "...";
        else
            return iconv_substr ( $str, $start, $length, $charset );
    }
    $re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all ( $re [$charset], $str, $match );
    $slice = join ( "", array_slice ( $match [0], $start, $length ) );
    if ($suffix)
        return $slice . "…";
    return $slice;
}

/**
 * 生成订单号
 * @param string $pre 前缀
 * @return string
 * @use $sn = create_order_sn();
 */
function create_order_sn($pre = "") {
    return $pre . date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}