<?php
require_once('Framework/Room.php');
require_once 'Framework/TextMessage.php';
class FirstRoom extends room{
	/* 进入房间时要显示的消息
	 * @param Message $msgKey	进入房间的Key
	 * @return Message 进入房间时要返回的消息
	 */
	public function OnOpen($msgKey){
		
		$str="1.今日十大\n2.版面列表";	
		return new TextMessage($str);
	}
	
	
	/*
	 * 设置附近的room

	 */
	protected  function SetNear(){
		
		$this->NewNear("1", 'ToptenRoom');
		
	}
	
}
?>