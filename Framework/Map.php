<?php
require_once '__sae.php';
/*
 * @author falling
 * @class Map
 * 该类应该被重载,模板见Map.templet
 */
abstract class Map{
	var $rooms;		//数组Room[string $roomName]
	var $mainRoomName;		//string主房间的房间名
	 
	
	/*
	 * 注册新的房间
	 * @param Room $room		//要注册的房间
	 */
	protected function NewRoom($room){
		$this->rooms[get_class($room)]=$room;
	}
	
	/*
	 *设定主房间
	 *@param string $roomName
	 */
	protected function setMainRoom($roomName){
		$this->mainRoomName=$roomName;
	}
	
	/*
	 * 获得现在所在的房间名
	 * @param string $openID
	 * @return string $roomName
	 */
	protected function getRoomNow($openID){
		$mc=memcache_init();
		return $mc->get($openID.'room');
	}
	
	/*
	 * 转移房间
	 * @param string $roomName				//要转移的房间
	 * @return Message		//要输出的信息
	 */
	protected function MoveToRoom($strKey,$openID,$roomName){
		
		$msg=$this->rooms[$roomName]->OnOpen($strKey,$openID);
		$mc=memcache_init();
		$mc->set($openID.'room',$roomName,0,300);		//记录房间名
		return $msg;
	}
	
	/*
	 * 进入地图
	 * @param string $openID
	 * @param string $strKey
	 */
	public function EnterMap($openID,$strKey){

		if($strKey=='0'){
			
			$msg=$this->MoveToRoom($strKey,$openID, $this->mainRoomName);	
			return $msg;
		}
		$roomNow=$this->getRoomNow($openID);
		if($roomNow==NULL){	//从未记录过
			$msg=$this->MoveToRoom($strKey,$openID, $this->mainRoomName);		//移动并获得输出的信息
		}else{					//已有记录,正在某房间中

			$where=$this->rooms[$roomNow]->getNear($strKey);		//获取要去的房间
			
			if($where==NULL){		//附近没有房间
				return NULL;
			}else{
				$msg=$this->MoveToRoom($strKey,$openID, $where);						
			}
		}
		return $msg;
	}
	
}
?>