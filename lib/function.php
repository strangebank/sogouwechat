<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 15/11/4
 * Time: 16:28
 */
function curl_get_file_contents($url)
{
    showAuthcode('http://weixin.sogou.com/antispider/util/seccode.php?tc='.time());
    $cookieFile = SCRIPT_ROOT.'cookie.txt';

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_COOKIEFILE, $cookieFile); //同时发送Cookie
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
    //curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36");
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.sogou.com)");
    $data = curl_exec($ch);
    $ret = $data;
    list($header, $data) = explode("\r\n\r\n", $data, 2);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    if ($http_code === 301 || $http_code === 302) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        if(!isset($matches[1]) || empty($matches[1]))
        {
            return $data;
        }

        $new_url = stripslashes(trim($matches[1]));
        return curl_get_file_contents($new_url);
    } else {
        list($header, $data) = explode("\r\n\r\n", $ret, 2);
        return $data;
    }
}
/**
 * 创建一个目录树
 * @param [type] $dir [description]
 * @param integer $mode [description]
 * @return [type]  [description]
 */
function mkdirs($dir, $mode = 0777) {
    if (!is_dir($dir)) {
        mkdirs(dirname($dir), $mode);
        return mkdir($dir, $mode);
    }
    return true;
}
/**
 * 加载目标网站图片验证码
 * @param string $authcode_url 目标网站验证码地址
 */
function showAuthcode( $authcode_url )
{
    $cookieFile = SCRIPT_ROOT.'cookie.txt';
    if(file_exists($cookieFile))return true;
    $ch = curl_init($authcode_url);
    curl_setopt($ch,CURLOPT_COOKIEJAR, $cookieFile); // 把返回来的cookie信息保存在文件中
    curl_exec($ch);
    curl_close($ch);
}