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
        #$this->html=getHtml($this->uri);
        echo $this->html;
        $this->parseSearchList($this->uri);
    }
    private function parseSearchList($uri){
        $this->getHtml($this->uri);
        $artlist = pq(".wx-rb_v1");
        foreach($artlist as $li){
            $url =  'http://weixin.sogou.com'.pq($li)->attr('href')."\r\n";
            //echo pq($li)->find('.txt-box >h4>span')->html()."\r\n";
            $this->parseWechatList($url);
            sleep(2);
            die;
        }

    }
    private function parseWechatList($uri){
        echo "Start:".$uri."\r\n";
        $this->getHtml($uri);
        $weixininfo = array();
        $weixininfo['name'] = pq('h3')->html();
        $weixininfo['ename'] = str_replace('微信号：','',pq('h4>span')->html());
        $weixininfo['brief']=pq('.sp-txt:first')->html();
        $weixininfo['company']=pq('.sp-txt:last')->html();

        $artlist = pq(".img_box2 >h4>a");
       # echo pq(".wx-rb3:last")->html();
        foreach($artlist as $li){
            echo pq($li)->html();
            echo 'X'.pq($li)->find('.news_lst_tab')->html();
            echo pq($li)->attr('href')."\r\n";
        }
    }
    private function parseWechatContents(){

    }
    private function getHtml($uri){
        if(!$uri)return false;
        $contents = curl_get_file_contents($uri);
        if($contents){
            return phpQuery::newDocumentHTML($contents);
        }
        return '';
    }
    function __destruct()
    {
    }
}