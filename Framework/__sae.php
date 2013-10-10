<?php
/*
 * 解决SAE与主机调用memCache不同的问题,迁移至SAE时请注释掉该文件
 */
//*
function memcache_init(){
	$mc=new mc();
	return $mc;
}
class mc{
	var $obj;
	function __construct(){
		$this->obj = memcache_connect("127.0.0.1", 11211);
	}
	public function get($name){
		return memcache_get($this->obj,$name);
	}
	
	public function set($name,$value,$zero,$long){
		memcache_set($this->obj,$name,$value,$zero,$long);
	}
	
}
//*/
?>