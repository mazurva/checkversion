<?php
$subject = file_get_contents('http://php.net/');
$text = '|<ol id="releases">(.*)</ol>|Uis';
preg_match ($text, $subject, $matches);
$pattern = '|<span class="release">(.*)</span>|Uis';
preg_match_all($pattern, $matches[1], $out);
//var_dump($out);
foreach($out[1] as $key => $version)
    echo $version . "\n";
    
?>