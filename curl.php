<?php
//获取历史上的今天事件
function get_history() {
    $hurl = curl_init();
    curl_setopt($hurl, CURLOPT_URL, "http://www.ipip5.com/today/api.php?type=json");
    curl_setopt($hurl, CURLOPT_HEADER, 0);
    curl_setopt($hurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($hurl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($hurl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($hurl, CURLOPT_ENCODING, '');
    curl_setopt($hurl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
    curl_setopt($hurl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($hurl);
    $data = json_decode($data,true);
    $history  = $data['result'][mt_rand(1,count($data['result'])-1)];
    return $history;
}
//获取IP对应的地理位置
function get_region() {
    $ip = $_SERVER["REMOTE_ADDR"];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.tcotp.cn/ip/?ip={$ip}");
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_ENCODING, '');
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
	curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($curl);
    //自动删除地理位置里的空格,使显示效果更好
    $region = str_replace(" " , "", str_replace("	" , "", $data));
	$region = substr($region, 3);
    //若未能查到地理位置,返回默认消息
    if(empty($region)) {
        $region = "幻想乡(未知IP)";
    }
    return $region;
}
$region = get_region();
$history = get_history();
