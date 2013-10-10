<?php
require_once 'Framework/Room.php';
require_once 'Request/ToptenRequest.php';

/*
 * @author falling 
 * 显示十大后的详细信息，在ToptenRoom的下一层
 */

class ToptenMoreRoom extends Room{
	/* 进入房间时要显示的消息
	 * @param Message $strKey	进入房间的Key
	 * @param string $openID
	 * @return Message 进入房间时要返回的消息
	 */
	public function OnOpen($strKey,$openID){
		$re=new ToptenRequest();		//初始化请求
		$intKey=intval($strKey, 10);	
	
		$str=$re->getPost($intKey);		//返回一楼
		return new TextMessage($str);
	}
	
	
	/*
	 * 设置附近的room
	 * @param Message $strKey
	 * @param string roomName
	 */
	protected  function SetNear(){
		
	}
}
?>