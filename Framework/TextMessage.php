<?php
require_once 'Message.php';
/*
 *@author falling
 *@class TextMessage
 */
class TextMessage extends Message{
	/*
	 *@param string $text信息的文本
	 */
	public function __construct($text){
		$this->data["text"]=$text;
		$xml="<xml>
		<ToUserName><![CDATA[%s]]></ToUserName>
 		<FromUserName><![CDATA[%s]]></FromUserName> 
		<CreateTime>%s</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
 		<Content><![CDATA[$text]]></Content>
 		<FuncFlag>0</FuncFlag>
 		</xml>";	
		$type="text";
		parent::__construct($type, $xml);
	}
	

}
?>