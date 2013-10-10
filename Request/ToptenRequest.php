<?php
require 'Request/ThreadRequest.php';

class ToptenRequest{
	var $jsonUrl;		//数据来源的JSON
    var $json;		//获取的JSON
    var $obj;		//解析后的对象
    var $table;		//二维数组，形式为array[TopID]={ID,board}
    var $rainUrl;
    /*
     * 初始化各项API资源
     */
    function __construct(){
		$this->jsonUrl='http://bbs.jnrain.com/rainstyle/topten_json.php';
        $this->json=file_get_contents($this->jsonUrl);
		$this->obj=json_decode($this->json);
		$this->rainUrl='http://bbs.jnrain.com/rainstyle/disparticle.php';
        $this->ToString();
    }
    
    function ToString(){			 //生成用于微信的十大榜单
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
     * @param int $topID数字
     */
    function getPost($topID){       //生成对应文章
		
        $board=$this->table[$topID]->board;
        $ID=$this->table[$topID]->ID;
       
    	$re=new ThreadRequest($board, $ID);
    	$str=$re->getPost(1);
     	return $str;
    }
}

?>
