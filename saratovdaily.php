<?php
require_once "libs/phpQuery.php";
require_once "libs/curl_query.php";
require_once  "libs/pattern.php";
require_once "libs/db.php";
exec('chcp 65001');

$url ="http://saratovdaily.ru/news";
$pattern = "~" . $text . "~si";
function parser_a($url){
    $obj[]=null;
     $html = phpQuery::newDocument(curl_get($url));
    foreach ($html->find("a") as $value){
        $a = pq($value)->attr("href");

        if (!in_array($a,$obj)){
            $obj[]=$a;
        }
    }
    return $obj;
}

function parser_p($url){
    $html = phpQuery::newDocument(curl_get($url));

    foreach ($html->find(".clearfix") as $value){
        $obj = pq($value);
        $text = $obj-> find("article")->text()."<br>"."<br>";

    }
    return $text;
}

$links= parser_a($url);

/*echo "<pre>";
print_r($links);*/


foreach ($links as $link){
    if (preg_match("~/news/20[1234567890]{2,2}/~siU",$link)) {
        $value= "http://saratovdaily.ru".$link;
        $content = parser_p($value);
        echo $value."<br>";


    }
}
phpQuery::unloadDocuments();

?>