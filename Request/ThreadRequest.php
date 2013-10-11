<?php 
require_once 'html2txt.lib.php';
/*
 * 获取具体的文章
 */
class ThreadRequest{
    var $jsonUrl;
    var $json;
    var $obj;
    var $postArray;     //string[int $i]表示$i楼的帖子
    public  function __construct($boardName,$ID,$page=1){
        
        $this->jsonUrl="http://bbs.jnrain.com/rainstyle/thread_json.php?boardName=".$boardName."&ID=".$ID;

        $this->json=file_get_contents($this->jsonUrl);
        $this->obj=json_decode($this->json);
        $i=0;
        
        foreach ($this->obj->posts as $po){

            $this->postArray[$i+1]=html2text($po->content);     //楼层从第一层开始(之前$i的$漏了你敢信！！我恨php)

            $i++;       //之前忘了这一句你敢信？
        }
        
    }
   /*
    * 返回n楼的帖子
    * @param int $n
    * @return string 
    */
    function getPost($n){

        return $this->postArray[$n];
    }
    
}
?>