<?php
set_time_limit(0);
define('SCRIPT_ROOT',dirname(__FILE__).'/');

#namespace Snoopy;
require 'vendor/autoload.php';
require_once(dirname(__FILE__).'/lib/init.inc.php');
$contents = new parsehtml();

foreach($keywords as $key){
    $category = $key;
    for($i=0;$i<1;$i++) {
        $url = 'http://weixin.sogou.com/weixin?type=1&query=' . $key . '&ie=utf8&page=' . $i;
        $contents->uri = $url;
        $contents->run();
        sleep(3);
        echo "parseUrlOk \r\n";
    }
    echo "parseKeyOK \r\n";
    sleep(2);
}

$pinyin=new \Pinyin\Pinyin();
$flord = $pinyin->GetPinyin("中国",0);;
mkdirs('./data/'.$flord);
#echo $pinyin->GetPinyin("中国",0);

exit();