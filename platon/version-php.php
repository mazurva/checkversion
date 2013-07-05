<?php

$subject = Parser::load('http://php.net/');
$text = '|<ol id="releases">(.*)</ol>|Uis';
preg_match ($text, $subject, $matches);
$pattern = '|<span class="release">(.*)</span>|Uis';
preg_match_all($pattern, $matches[1], $out);
//var_dump($out);
//foreach($out[1] as $key => $version)
    //echo $version."\n";
    return ($out[1]);
    echo ($out[1]);
?>