<?php
require_once 'Message.php';
/*
 * @author falling
 * @class Room
 * 该类应被继承
 */
abstract class Room{
	var $nearRoom;	 	//string[$strKey]，存储下一个要打开的房间名
	
	/* 进入房间时要显示的消息
	 * 该函数应该被重载
	 * @param Message $strKey	进入房间的Key
	 * @return Message 进入房间时要返回的消息
	 */
	public function OnOpen($strKey){
		
	}
	
	
	/*
	 * 返回对应的房间
	 * @param string $strKey
	 * @return string 对应的房间名
	 */
	public function getNear($strKey){

		$this->setNear();
		if($this->nearRoom!=NULL){		//附近有房间
  		$strKey=$strKey.'';		//!!!未知Bug，用该方式暂时处理
			if($this->nearRoom[$strKey]==NUll){		//未定义的key
				return NULL;
			}else{
				return $this->nearRoom[$strKey];
			}
		}else{	//没有房间	
			return NULL;
		}
	}
	/*
	 * 设置附近的room
	 * 该函数应该被重载
	 * @param string $strKey
	 * @param string roomName
	 */
	protected  function setNear(){
		
	}
	
	/*
	 * 注册nearRoom
	 * @param string $strKey
	 * @param string $roomName
	 */
	protected function NewNear($strKey,$roomName){
		$this->nearRoom[$strKey]=$roomName;
	}
}
?>