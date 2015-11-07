<?php
set_time_limit(0);
#namespace Snoopy;
require 'vendor/autoload.php';
require_once(dirname(__FILE__).'/lib/init.inc.php');


$pinyin=new \Pinyin\Pinyin();

echo $pinyin->GetPinyin("中国",0);
die;


$url = 'http://weixin.sogou.com/weixin?type=1&query=备孕&ie=utf8';
$rs = curl_get_file_contents($url);
phpQuery::newDocumentHTML($rs);
$artlist = pq(".wx-rb_v1");
foreach($artlist as $li){
   echo 'http://weixin.sogou.com'.pq($li)->attr('href')."     >>>";
  # die;
}
exit();