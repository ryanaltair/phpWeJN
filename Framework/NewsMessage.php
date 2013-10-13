<?php
require_once 'Message.php';
/*
 *@author falling
 *图文信息类
 */
class NewsMessage extends Message{
	/**
	 * 初始化图文信息
	 * @param [Array] $itemsArray [要输出的图文数组]
	 * $itemsArray=array(
	 * 0	=>	array(
	 * 			"title" =>	"标题",
	 * 		 	"description"	=>	"描述",
	 * 		  	"picUrl"	=>	"图片的地址",
	 * 		   	"Url"	=>	"链接的地址"
	 * 		)
	 * 1	=>	array....
	 * )
	 */
	public function __construct($itemsArray){

		$itemXML='';
		$itemXMLTpl="<item>
 		<Title><![CDATA[%s]]></Title>
 		<Description><![CDATA[%s]]></Description>
 		<PicUrl><![CDATA[%s]]></PicUrl>
 		<Url><![CDATA[%s]]></Url>
 		</item>";			//item的模板
 		//完成item部分XML的初始化
 		$count=0;				//文章的个数
		foreach ($itemsArray as $item) {
			$tempXML=sprintf($itemXMLTpl,$item["title"],$item["description"],$item["picUrl"],$item["Url"]);
			$itemXML=$itemXML.$tempXML;
			$count++;
 		}

		$headXML="<xml>
 		<ToUserName><![CDATA[%s]]></ToUserName>
 		<FromUserName><![CDATA[%s]]></FromUserName>
 		<CreateTime>%s</CreateTime>
 		<MsgType><![CDATA[%s]]></MsgType>
 		<ArticleCount>$count</ArticleCount>
 		<Articles>";		//XML的头部
 		$endXML='</Articles></xml>';	//XML的尾部
 		$xml=$headXML.$itemXML.$endXML;
 		
		$type="news";
		parent::__construct($type, $xml);
	}
	


}
?>