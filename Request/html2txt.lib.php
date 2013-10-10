<?php
/*
 * ��htmlת��Ϊ�ı�
 * �ٶȵĴ��룬��Ҫ̫�������Ļ���- -
 * @string str Ҫת�����ַ���
 * @return string���ص��ַ���
 */
function html2text($str)
{
 $str = preg_replace("/<sty(.*)\/style>|<scr(.*)\/script>|<!--(.*)-->/isU","",$str);
 $alltext = "";
 $start = 1;
 for($i=0;$i<strlen($str);$i++)
 {
  if($start==0 && $str[$i]==">")
  {
   $start = 1;
  }
  else if($start==1)
  {
   if($str[$i]=="<")
   {
    $start = 0;
    $alltext .= " ";
   }
   else if(ord($str[$i])>31)
   {
    $alltext .= $str[$i];
   }
  }
 }
 $alltext = str_replace("��"," ",$alltext);
 $alltext = preg_replace("/&([^;&]*)(;|&)/","",$alltext);
 $alltext = preg_replace("/[ ]+/s"," ",$alltext);
 return $alltext;
}

?>