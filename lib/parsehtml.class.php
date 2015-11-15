<?php
/**
 * Class parsehtml
 */
class parsehtml{
    var $html = '';
    var $uri = '';
    function __construct() {
        echo $this->uri;
        //$this->uri = $uri;
    }
    public function run(){
        $this->parseSearchList($this->uri);
    }
    private function parseSearchList($uri){
        $this->getHtml($this->uri);
        $artlist = pq(".wx-rb_v1");
        foreach($artlist as $li){
            $weixininfo = array();
            $url =  'http://weixin.sogou.com'.pq($li)->attr('href');
            $this->parseWechatList($url);
           sleep(2);
        }

    }
    private function parseWechatList($uri){
        echo "\r\n StartDetail==>".$uri."\r\n";
        $this->getHtml($uri);
        $weixininfo = array();
        $weixininfo['name'] = pq('.txt-box #weixinname')->html();
        $weixininfo['ename'] = str_replace('微信号：','',pq('h4>span')->html());
        $weixininfo['brief']=pq('.sp-txt:first')->html();
        $weixininfo['company']=pq('.sp-txt:eq(1)')->html();
        print_r($weixininfo);
        $url=str_replace('gzh','gzhjs',$uri);
        $this->parseWechatContents($url);
    }
    private function parseWechatContents($uri){
        echo "\r\n StartDetailArticls==>".$uri."\r\n";
        $option =array('username'=>'x','password'=>'x','dataType'=>'jsonp','openid'=>'oIWsFtw_7gB_cuYwH0Uwoamx0lMI','ext'=>'_L45N5QlA_VVl_aoTx3tUFypb98KD5t9cdays8xKDEERpb8tj-663w3PuCc0GvTx');
        phpQuery::getJSON($option,'gzh')   ;
        die;
    }
    private function getHtml($uri){
        #return phpQuery::newDocumentFile($uri);
        if(!$uri)return false;
        $contents = curl_get_file_contents($uri);
        if($contents){
            $doc = phpQuery::newDocumentHTML($contents);
            #phpQuery::$documents = array();
            return $doc;
        }
        return false;
    }
    function __destruct()
    {
    }
}