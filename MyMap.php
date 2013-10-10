<?php
require_once 'Framework/Map.php';
require_once 'FirstRoom.php';
require_once 'ToptenRoom.php';
require_once 'ToptenMoreRoom.php';
class MyMap extends Map{
	function __construct(){
		$mainRoom=new FirstRoom();
		$this->NewRoom($mainRoom);
		$this->setMainRoom(get_class($mainRoom));
		$this->NewRoom(new ToptenRoom());
		$this->NewRoom(new ToptenMoreRoom());
	}
}
?>