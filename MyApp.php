<?php
require_once 'Framework/WeApp.php';
require_once 'Framework/TextMessage.php';
require_once 'Framework/NewsMessage.php';
require_once 'MyMap.php';
/*
 * @author falling
 * @class WeApp
 * App主类
 */
class MyApp extends WeApp{
	/*
	 *响应信息
	 *@param Message $msg
	 */
	protected function OnText($text){
		$map=new MyMap();
		$out=$map->EnterMap($this->fromUsername,$text);	//进入地图，并得到反馈的信息
		if($out!=NULL){		//信息被处理并回复
			$this->Put($out);
		}else{				//信息未处理

			$this->Put(new TextMessage("未定义的命令，按[0]返回主菜单"));
		}
	}
	
	protected function OnLocation($x, $y, $scale){
		
	}
	
	protected function OnImage($picUrl){
		
	}
}
?>