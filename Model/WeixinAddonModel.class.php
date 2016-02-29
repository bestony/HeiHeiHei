<?php
        	
namespace Addons\HeiHeiHei\Model;
use Home\Model\WeixinModel;
        	
/**
 * HeiHeiHei的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$data = $this->getQueryParam('JUFD-571');
        $contents = $this->getQueryList($data);
        $resutl = $this->getQueryResult($contents);
        $link = str_replace('&amp;','&',urldecode($resutl[1]));
        if ($link == null){
	        $this->replyText('请稍后查询！目前人多，服务器压力较大！');
        }else{
	    	$this->replyText($link);    
        }
		
	} 

	// 关注公众号事件
	public function subscribe() {
		return true;
	}
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click() {
		return true;
	}
		private function getQueryResult($contents){
        $result = array();
        preg_match('#<a onclick="fclck\(this.href\)" href="(.*)" title="Download via magnet-link">\[magnet-link\]</a>#iUs', $contents, $content);
        $result = $content;
        return $result;
    }
     
     
    //获取btdigg.org 的查询数据
    private function getQueryList($data){
        $data['order'] = $data['order'] ? $data['order'] : 0;
        $data['p'] = 0;
        $ch = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, 'https://btdigg.org/search?'.http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36');
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
         
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
 	private function getQueryParam($str){
        $data = array();
        $string = explode(' ', $str);
         
        //是数组 and 最后一个数组是数字
        $last = array_pop($string);
        if(is_numeric($last)){
            $data['q'] = implode(' ', $string);
            $data['order'] = $last;
        }else{
            $data['q'] = $str;
        }
        return $data;
    }
}
        	