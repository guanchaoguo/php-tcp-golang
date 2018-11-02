<?php
$timeout = 5;

// 连接服务器
$fp = fsockopen("tcp://127.0.0.1",9988,$errno, $errstr, $timeout) or die($errno);

 //远程数据接收或发送超时时间
stream_set_timeout($fp, $timeout);

//$data 按照一定格式被打包成二进制数据
$header ='www.01happy.com';
$str = '{"Id":1,"Name":"golang","Message":"message"}';
$len= strlen($str);
$data =  pack('A15N1A44',$header,$len,$str);

// 发送数据
for ($i=0; $i<10;$i++) {
      fwrite($fp, $data);
}

// 读取数据
for ($i=0; $i<10;$i++) {
  $rs = fread($fp, 63);
  $format = "A15header/Nlen/A44content";
  $data = unpack($format, $rs);
}

// 关闭连接 
fclose($fp);
