<?php 
require_once 'html2txt.lib.php';
/*
 * 链接具体的帖子
 */
class ThreadRequest{
    var $jsonUrl;
    var $json;
    var $obj;
    var $postArray;     //string[int $i] 存储帖子
    public  function __construct($boardName,$ID,$page=1){
        
        $this->jsonUrl="http://bbs.jnrain.com/rainstyle/thread_json.php?boardName=".$boardName."&ID=".$ID;

        $this->json=file_get_contents($this->jsonUrl);
        $this->obj=json_decode($this->json);
        $i=0;
        
        foreach ($this->obj->posts as $po){

            $this->postArray[$i+1]=html2text($po->content);     //帖子是从一楼开始

            $i++;       //之前给漏了
        }
        
    }
   /*
    * 获得帖子的n楼
    * @param int $n         //楼层
    * @return string        //返回具体楼层的内容
    */
    function getPost($n){

        return $this->postArray[$n];
    }
    
}
?>