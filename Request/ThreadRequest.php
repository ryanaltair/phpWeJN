<?php 
require_once 'Request.php';
require_once 'html2txt.lib.php';
/*
 * 获取具体的文章
 */
class ThreadRequest extends Request{
    /*
     *  InArray=array(
     *      "ID" => "帖子的ID",
     *      "boardName" => "板块名",
     *  )
     *
     *  OutArray=array(
     *      "title" => "帖子的标题",
     *      "content" => "一楼的内容",
     *      "link" => "帖子的链接"
     *  )
     */
    public function doRequest($inArray){

        $boardName=$inArray["boardName"];
        $ID=$inArray["ID"];
        $APIUrl="http://bbs.jnrain.com/rainstyle/thread_json_ubb.php?boardName=".$boardName."&ID=".$ID;     
        $LinkUrl="http://www.jnrain.com/rainstyle/disparticle.php?boardName=".$boardName."&ID=".$ID;    //帖子的链接地址
        //下面开始解析
        $json=file_get_contents($APIUrl);
        $obj=json_decode($json);
        $outArray=array(
            "title" => $obj->posts[0]->title,
            "content" => $obj->posts[0]->content,
            "link" => $LinkUrl
        );

        return $outArray;

    }
    
}
?>