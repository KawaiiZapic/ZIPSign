<?php
// 引用函数库，设置基础环境信息
include('function.php');
include('curl.php');
error_reporting(0);
SESSION_START();
header("Content-type: image/PNG");

// 然并卵，用文件储存访问量并不是什么高明的方法
// 在高并发请求下很容易出现文件死锁导致访问量变成 0
if(!file_exists("counter.dat")) {
    file_put_contents("counter.dat", 1);
}
$counter = intval(file_get_contents("counter.dat"));

// 取用户信息，获取要写的文本
$ip = $_SERVER["REMOTE_ADDR"];
$weekarray = Array("日", "一", "二", "三", "四", "五", "六");
$historyt = substr($history, 0, strpos($history, ' '));
$historye = substr($history, strpos($history, ' '));
$font = "./msyh.ttf";
$date = date("Y年n月j日");
$week = $weekarray[date("w")];

// 在图片上面写字
$img = imagecreatefrompng(mt_rand(1,2) . ".png");
$clr = ImageColorAllocate($img, 240, 240, 240);
imagettftext($img, 20, 0, 10, 45, $clr, $font, "你好,来自{$region}的朋友!");
imagettftext($img, 20, 0, 10, 75, $clr, $font, "今天是{$date} 星期{$week}");
imagettftext($img, 20, 0, 10, 105, $clr, $font, "在{$historyt}的今天，{$historye}");
imagettftext($img, 20, 0, 10, 135, $clr, $font, "您的IP是：{$ip}，是个吉利的数字呢!");
imagettftext($img, 20, 0, 10, 165, $clr, $font, "您正在{$os}上使用{$bro}呢");
imagettftext($img, 20, 0, 10, 195, $clr, $font, "这个签名已经被{$counter}人次看到了呢");
ImagePNG($img);
ImageDestroy($img);

// 访问计数（然并卵）
// 增加文件死锁判断，防止计数器因为文件死锁而清零
if(!isset($_SESSION['viewed']) && $counter !== 0) {
    $_SESSION['viewed'] = true;
    $counter++;
    file_put_contents("counter.dat", $counter);
}
