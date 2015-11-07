<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 15/11/4
 * Time: 16:28
 */
function curl_get_file_contents($url)
{

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_BINARYTRANSFER,true);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36");
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