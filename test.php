<?php

class TestClass{
    
}

function getHashTag($string)
{
    preg_match_all('/\B#(\w+)/',$string,$subpatten);
    return $subpatten[1];
}
function getBalance($string)
{
    preg_match_all('/\B@(\d+)/',$string,$subpatten);
    return $subpatten[1];
}

// misalnya parameter yang dimasukkan adalah /home/ata/1.html
// patternnya /:controller/:action/:id.html
function getParams($string){
    preg_match_all('/\:(\w+)/i',$string,$subpatten);
    return $subpatten;
}

function quouteUrl($str){
    return preg_quote(str_replace(':','',$str));
}

$result = getHashTag("Saya sedang #makan malam dengan pacar saya kemudian #nonton di bioskop");
$result2 = getBalance("Saya sedang #makan malam @400 dengan pacar saya kemudian #nonton di bioskop menghabiskan @10000");
$url = '/:controller/:action/:id.html';
$result3 = getParams($url);

//print_r($result);
//print_r($result2);
$result4 = array_map(function($n){return "(?P<" . $n . ">\w+)";}, $result3[1]);
$result5 = '/'.str_replace($result3[1],$result4, str_replace(array(':','/','.'),array('','\/','\.'),$url)).'/i';
print_r($result3);
print_r($result4);

var_dump($result5);






