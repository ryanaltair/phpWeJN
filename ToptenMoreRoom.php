<?php
require_once 'Framework/Room.php';
require_once 'Request/ToptenRequest.php';
require_once 'Request/ThreadRequest.php';
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
		$strKey=$strKey."";
		$topReq=new ToptenRequest();	//链接听雨BBS十大
		$topReq->setRequest(NULL);		
		$topArray=$topReq->getRequest();

		//为请求具体的帖子准备
		$readReq=new ThreadRequest();

		$inArray=array(
			"ID" => $topArray[$strKey]["ID"],
			"boardName" => $topArray[$strKey]["boardName"]
		);
		$readReq->setRequest($inArray);
		//读取
		$readArray=$readReq->getRequest();
		$str=$readArray["title"];
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