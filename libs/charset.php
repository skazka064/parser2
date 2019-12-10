<?php
function detect_charset($str){
    if(preg_match("/windows-1251/i", $str)){
        return "windows-1251";
    }
    elseif(preg_match("/utf-8/i", $str)){
        return "utf-8";
    }
    else{
        return "windows-1251";
    }
}



?>
