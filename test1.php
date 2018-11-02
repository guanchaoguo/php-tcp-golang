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

  $i = 0;
   while($i <10 ) {
      $i++;
      $rs = fread($fp, 63);
      $format = "A15header/Nlen/A44content";
      $data = unpack($format, $rs);
      
      print_r($data);
        
 } 
 fclose($fp);
}