<?php $counter = intval(file_get_contents("counter.dat")); include 'function.php'; include 'curl.php';?>
<?php
error_reporting( E_ALL&~E_NOTICE );
header("Content-type: image/PNG");
$img = imagecreatefrompng(rand(1,2).".png"); //随机选择底图
$ip = $_SERVER["REMOTE_ADDR"];  //获取用户IP
$weekarray=array("日","一","二","三","四","五","六"); //星期数组
$historyt = substr($history,0,strpos($history,' ')); //将历史上的今天年份与事件分离
$historye = substr($history,strpos($history,' ')); 
$clr = ImageColorAllocate($img, 240,240,240);  //定义字体颜色
$font = './msyh.ttf';  //定义字体
//绘图
imagettftext($img, 20, 0, 10, 45, $clr, $font,'你好,来自'.$region.'的朋友!');
imagettftext($img, 20, 0, 10, 75, $clr, $font, '今天是'.date('Y年n月j日')." 星期".$weekarray[date("w")]);//当前时间添加到图片
imagettftext($img, 20, 0, 10, 105, $clr, $font,'在'.$historyt.'的今天,'.$historye);
imagettftext($img, 20, 0, 10, 135, $clr, $font,'您的IP是:'.$ip.",是个吉利的数字呢!");//ip
imagettftext($img, 20, 0, 10, 165, $clr, $font,'您正在'.$os.'上'.'使用'.$bro.'呢');
imagettftext($img, 20, 0, 10, 195, $clr, $font,'这个签名已经被'.$counter.'人次看到了呢'); 
//输出
ImagePNG($img);
//销毁
ImageDestroy($img);
?>
<?php
//访问计数
    $counter = intval(file_get_contents("counter.dat"));  
     $_SESSION['#'] = true;  
     $counter++;  
     $fp = fopen("counter.dat","w");  
     fwrite($fp, $counter);  
     fclose($fp); 
 ?>
