<?php
function curl_get($url,$proxy= '10.64.116.5:3128', $referer = 'http://www.google.com'){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_HEADER,true);
    curl_setopt($ch, CURLOPT_USERAGENT ,"Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0");
    curl_setopt($ch, CURLOPT_PROXY, "$proxy");
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}



?>