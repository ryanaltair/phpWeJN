<?php
require_once 'Framework/Room.php';
require_once 'Request/ToptenRequest.php';
require_once 'Framework/TextMessage.php';
/*
 * 显示江南听雨BBS的十大列表
 * @author falling
 * @class ToptenRoom
 */
class ToptenRoom extends Room{
	/* 进入房间时要显示的消息
	 * @param Message $strKey 进入房间的Key
	 * @return Message 进入房间时要返回的消息
	 */
	public function OnOpen($strKey){

		$request=new ToptenRequest();	//链接听雨BBS十大
		$str=$request->ToString();
		return new TextMessage($str);
	}


	/*
	 * 设置附近的room
	 */
	protected function SetNear(){
		for($i=1;$i<=10;$i++){
			$strKey=$i.'';
			$this->NewNear($strKey, 'ToptenMoreRoom');
		}


	}
}
?>