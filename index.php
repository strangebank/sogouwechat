<?php
require 'vendor/autoload.php';


phpQuery::newDocumentFile('http://www.helloweba.com/blog.html'); 
$artlist = pq(".blog_li"); 
foreach($artlist as $li){ 
   echo pq($li)->find('h2')->html().""; 
} 
