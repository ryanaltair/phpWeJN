<?php 
require_once 'html2txt.lib.php';
/*
 * ��ȡ���������
 */
class ThreadRequest{
    var $jsonUrl;
    var $json;
    var $obj;
    var $postArray;		//string[int $i]��ʾ$i¥������
    public  function __construct($boardName,$ID,$page=1){
     	
		$this->jsonUrl="http://bbs.jnrain.com/rainstyle/thread_json.php?boardName=".$boardName."&ID=".$ID;

		$this->json=file_get_contents($this->jsonUrl);
		$this->obj=json_decode($this->json);
		$i=0;
		
		foreach ($this->obj->posts as $po){

			$this->postArray[$i+1]=html2text($po->content);		//¥��ӵ�һ�㿪ʼ(֮ǰ$i��$©������ţ����Һ�php)

			$i++;		//֮ǰ������һ������ţ�
		}
        
    }
   /*
    * ����n¥������
    * @param int $n
    * @return string 
    */
    function getPost($n){

        return $this->postArray[$n];
    }
	
}
?>