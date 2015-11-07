<?php

/**
 * Class parsehtml
 */
class parsehtml{
    var $html = '';
    var $uri = '';
    function __construct() {
        //$this->uri = $uri;
    }
    public function run(){
        echo $this->uri;
        $this->html=curl_get_file_contents($this->uri);
        echo $this->html;
        $this->parseSearchList();
    }
    private function parseSearchList(){
        phpQuery::newDocumentHTML($this->html);
        $artlist = pq(".wx-rb_v1");
        foreach($artlist as $li){
            echo 'http://weixin.sogou.com'.pq($li)->attr('href')."     >>>";
            echo pq($li)->find('.txt-box >h4>span')->html();
            die;
        }

    }
    private function parseWechatList(){

    }
    private function parseWechatContents(){

    }
    function __destruct()
    {
    }
}