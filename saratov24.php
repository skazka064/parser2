<?php

require_once "libs/phpQuery.php";
require_once "libs/curl_query.php";
require_once  "libs/pattern.php";
require_once "libs/db.php";
exec('chcp 65001');

$url ="https://saratov24.tv";
$pattern = "~" . $text . "~si";
function parser_a($url){
    $html = phpQuery::newDocument(curl_get($url));
    foreach ($html->find("a") as $value){
        $obj[] = pq($value)->attr("href");
    }
    return $obj;
}

function parser_p($url){
    $html = phpQuery::newDocument(curl_get($url));

    foreach ($html->find(".article-body") as $value){
        $obj = pq($value);
        $text = $obj-> find("p")->text()."<br>"."<br>";
    }
    return $text;
}

$links= parser_a($url);

/*echo "<pre>";
print_r($links);*/

foreach ($links as $link){
    if (preg_match("~/news/~siU",$link)) {
        $value= "https://saratov24.tv".$link;
        $content = parser_p($value);
        if (preg_match($pattern, $content)&& !in_array($value, $outs) && !in_array($value, $ahref)){
            $outs[] = $value;
            $date = date('d.m.Y H:i:s');
            $sql = "INSERT INTO p_table(date,ahref,text) VALUES('$date','$value','$content')";
            $res = $db->exec($sql);
            /*echo $value."<br>";
            echo $content."<br>";*/
        }
    }
}
?>