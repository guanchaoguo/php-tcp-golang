<?php
$timeout = 5;
$fp = fsockopen("tcp://127.0.0.1", 9988, $errno, $errstr, $timeout/* 连接超时时间 */);
if (!$fp) {
 echo "$errstr ($errno)<br />\n";
} else {
 stream_set_timeout($fp, $timeout);
 //远程数据接收或发送超时时间

$header ='www.01happy.com';
$str = '{"Id":1,"Name":"golang","Message":"message"}';
$len= strlen($str);
 $data =  pack('A15N1A44',$header,$len,$str);
 //$data 按照一定格式被打包成二进制数据
 for ($i=0; $i<10;$i++) {
    fwrite($fp, $data);
 }

 
 if (!feof($fp)) {
  $rs = fread($fp, 1024);
  //读取远程数据
  if ($rs) {
   $len = strlen($rs);
   //$len 可以获取数据的长度，用以计算content的长度
   //在这个例子中，content 的长度为 4
 
   $format = "A15header/Nlen/A44content";
   $data = unpack($format, $rs);
 
   print_r($data);
  } else {
   echo "timeout!";
  }
 } else {
  echo "timeout!";
 }
 fclose($fp);
}