<?php
require 'Request/ThreadRequest.php';

class ToptenRequest{
	var $jsonUrl;		//JSON的请求地址
    var $json;		//获得的JSON
    var $obj;		//JSON解析后的对象
    var $table;		//Aarray[TopID]={ID,board},存储解析后的列表
    var $rainUrl;
    /*
     * 初始化API
     */
    function __construct(){
		$this->jsonUrl='http://bbs.jnrain.com/rainstyle/topten_json.php';
        $this->json=file_get_contents($this->jsonUrl);
		$this->obj=json_decode($this->json);
		$this->rainUrl='http://bbs.jnrain.com/rainstyle/disparticle.php';
        $this->ToString();
    }
    
    function ToString(){			 //返回具体的列表文本
        $posts=$this->obj->posts;
        $i=1;
        foreach($posts as $topic){
        	$str=$str.$i.'.'.$topic->title."\n";
           
   			$this->table[$i]->ID=$topic->id;
            $this->table[$i]->board=$topic->board;
             $i++;
        }
		
       	return $str;
    }
    
    /*
     * @param int $topID 十大列表中帖子的ID（1-10）
     */
    function getPost($topID){       //获取帖子
		
        $board=$this->table[$topID]->board;
        $ID=$this->table[$topID]->ID;
       
    	$re=new ThreadRequest($board, $ID);
    	$str=$re->getPost(1);
     	return $str;
    }
}

?>
