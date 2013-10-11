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
		$request->setRequest(NULL);		
		$reqArray=$request->getRequest();
		$str=$this->getStrList($reqArray);		//生成列表
		
		return new TextMessage($str);
	}

	/*
	 * 获取文字式的列表
	 * @param array $array  //Request提供的array
	 * @return string 要返回的文本
	 */
	function getStrList($array){
		$i=1;				//序号
		foreach ($array as $post) {
			$str=$str.$i.'.'.$post['title'].'\n';
			$i++;
		}
		return $str;
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