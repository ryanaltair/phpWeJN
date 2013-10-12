<?php
//------------ClassName:WeApp--------------------------------
//------------Tip:此为抽象类，不能被实例化-------------

abstract class WeApp{
    var $fromUsername,$toUsername,$time;		//存储一些值用于Output

    function __construct(){

		//---------- 接 收 数 据 ---------- //

		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; //获取POST数据

		//用SimpleXML解析POST过来的XML数据
		$postObj = simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);

		$this->fromUsername = $postObj->FromUserName; //获取发送方帐号（OpenID）
		$this->toUsername = $postObj->ToUserName; //获取接收方账号
		$msgType=$postObj->MsgType; //获取信息类型
	
		$this->time = time(); //获取当前时间戳

		$this->dispacth($msgType,$postObj);
	}
    
    private function dispacth($msgType,$postObj){
    
    	//-------按照信息类型分配Process---------------//
        if($msgType=="text"){		//消息为文本
    		$this->OnText($postObj->Content);		//传递文本内容
        }elseif($msgType=="image"){		//消息为图片
        	$this->OnImage($postObj->PicUrl);		//传递图片地址
        }elseif($msgType=="location"){
			$this->OnLocation($postObj->Location_X,$postObj->Location_Y,$postObj->Scale);
        }
    }
    
    abstract protected function OnText($text);		//处理文本信息,$text为收到的文本信息
    

    abstract protected function OnImage($picUrl);		//处理图片信息,$picUrl为收到的图片地址

    abstract protected function OnLocation($x,$y,$scale);		//处理地理位置信息,$x,$y分别表示位置坐标，$scale表示地图缩放大小
 
	/*
	 * 输出Message
	 * @param Message $msg要输出的Message
	 */
	protected function Put($msg){
	
		$xml=$msg->getXML($this->fromUsername,$this->toUsername,$this->time );
		echo $xml;
	}
	

}
?>