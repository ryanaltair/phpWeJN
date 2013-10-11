<?php

/*
 * @author falling
 * @class Message
 * 该类为抽象类,应该被继承啊
 * 子类模板见Message.templet
 */
abstract class Message{
	var $type;
	var $xml;
	public $data;		//数组，存放数据
	/*
	 * 构造函数应该被重载
	 * 在子类中构造完成后呼叫该构造函数
	 * @param string $type Message类型
	 * @param string $xml 子类处理后的$xml
	 */
	public function __construct($type,$xml){
		$this->type=$type;
		$this->xml=$xml;
	}


	/*
	 * 返回类型
	 * @return string 要返回的类型
	 */
	public function getType(){
		return $this->type;
	}
	
	/*
	 * 返回供输出的XML
	 * @param string $formUserName
	 * @param string $toUserName
	 * @param string $toUserName
	 * @return string输出的XML
	 */
	public function getXml($fromUserName,$toUserName,$createTime){
		$resultStr=$this->xml;

		$resultStr = sprintf($resultStr,$fromUserName,$toUserName,$createTime,$this->type);
		return $resultStr;
	}
	
	//用于识别信息
	public function getKeyID(){
		return $this->xml;
	}
}