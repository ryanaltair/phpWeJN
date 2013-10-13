<?php
//require 'Request/ThreadRequest.php';
require_once 'Request.php';

class ToptenRequest extends Request{
	/*
	 * inArray=NULL
	 * outArray=array(
	 * 		"0" => array(
	 * 			"title" => "第一条帖子标题",
	 * 			"ID" => "帖子在BBS的ID"，
	 * 			"boardName" => "帖子所在的板块名",
	 * 		)
	 * 		"1" =>....
	 * )
	 */
	public function doRequest($inArray){
		$APIUrl='http://bbs.jnrain.com/rainstyle/topten_json.php'; 	//API地址，返回JSON
		$json=file_get_contents($APIUrl);	
		$obj=json_decode($json);

		//下面构建返回数据
		$outArray = array();
		foreach ($obj->posts as $post){
				$outArray[]=array(		
				"title" => $post->title,
				"ID" => $post->id,
				"boardName" => $post->board,
			);		
		}
		
		return $outArray;
	}
	
	
	
}

?>
