<?php
require 'vendor/autoload.php';
$url = 'http://weixin.sogou.com/weixin?type=1&query=备孕&ie=utf8';
phpQuery::browserGet($url);
$artlist = pq(".wx-rb_v1 _item");
foreach($artlist as $li){ 
   echo pq($li)->find('h2')->html().""; 
} 
