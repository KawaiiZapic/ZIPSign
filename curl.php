<?php
error_reporting( E_ALL&~E_NOTICE );//屏蔽某些不影响执行的错误提示,避免无法显示图片.
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';//UA
//获取历史上的今天事件
function get_history(){
$historyurl="https://apa.me/mz/today.php";
$hurl = curl_init(); 
curl_setopt($hurl, CURLOPT_URL, $historyurl); 
curl_setopt($hurl, CURLOPT_HEADER, 0);  
curl_setopt($hurl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($hurl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($hurl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($hurl, CURLOPT_ENCODING, '');  
curl_setopt($hurl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($hurl, CURLOPT_FOLLOWLOCATION, 1);  
$historyc = curl_exec($hurl);
$history = json_decode($historyc, true);
$history = $history[rand(1,15)];  //从15条内随机挑选一条
$history = str_replace("\n","",$history);  //删除换行,API不知道为什么会有换行.
return $history;
}
$history = get_history();
?>
<?php
error_reporting( E_ALL&~E_NOTICE );
//获取IP对应的地理位置
function get_region(){
$ip = $_SERVER["REMOTE_ADDR"];
$url="http://opendata.baidu.com/api.php?co=&resource_id=6006&t=1412300361645&ie=utf8&oe=utf-8&cb=&format=json&tn=baidu&query=".$ip; 
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);  
curl_setopt($curl, CURLOPT_ENCODING, '');  
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);  
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);  
$data = curl_exec($curl);
$data = json_decode($data, true);
$data = $data['data']['0']['location'];
//自动删除地理位置里的空格,使显示效果更好
if(strpos($data,' ') !== false){ 
  $region = substr ($data,0,strpos($data,' '));
}else{
 $region = $data; 
}
//若未能查到地理位置,返回默认消息
if ($region === NULL) {
	$region = "幻想乡(未知IP)";
}
return $region;
}
$region = get_region();
?>
