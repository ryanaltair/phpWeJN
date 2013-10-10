<?php
require 'Request/ThreadRequest.php';

class ToptenRequest{
	var $jsonUrl;		//������Դ��JSON
    var $json;		//��ȡ��JSON
    var $obj;		//������Ķ���
    var $table;		//��ά���飬��ʽΪarray[TopID]={ID,board}
    var $rainUrl;
    /*
     * ��ʼ������API��Դ
     */
    function __construct(){
		$this->jsonUrl='http://bbs.jnrain.com/rainstyle/topten_json.php';
        $this->json=file_get_contents($this->jsonUrl);
		$this->obj=json_decode($this->json);
		$this->rainUrl='http://bbs.jnrain.com/rainstyle/disparticle.php';
        $this->ToString();
    }
    
    function ToString(){			 //��������΢�ŵ�ʮ���
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
     * @param int $topID����
     */
    function getPost($topID){       //���ɶ�Ӧ����
		
        $board=$this->table[$topID]->board;
        $ID=$this->table[$topID]->ID;
       
    	$re=new ThreadRequest($board, $ID);
    	$str=$re->getPost(1);
     	return $str;
    }
}

?>
