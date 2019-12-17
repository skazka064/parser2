<?php
require_once "libs/phpQuery.php";
require_once "libs/curl_query.php";
require_once  "libs/pattern.php";
require_once "libs/db.php";
exec('chcp 65001');
$url ="https://stepnoe-adm.ru";
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
    foreach ($html as $value){
        $text = htmlspecialchars(pq($value)->find("div.text")->text());
    }
    return $text;
}

$links= parser_a($url);

echo "<pre>";
print_r($links);

foreach ($links as $link){
    if (preg_match("~^[/]~siU",$link)) {
        $value= "https://stepnoe-adm.ru".$link;
        /*echo $value."<br>";*/
        $content = parser_p($value);
        if (preg_match($pattern, $content)&& !in_array($value, $outs) && !in_array($value, $ahref)){
            $outs[] = $value;
            $date = date('d.m.Y H:i:s');
            $sql = "INSERT INTO p_table(date,ahref,text) VALUES('$date','$value','$content')";
            $res = $db->exec($sql);
            echo $value."<br>";
            echo $content."<br>";
        }
    }

}
phpQuery::unloadDocuments();

?>