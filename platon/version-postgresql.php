<?php
$subject = file_get_contents('http://www.postgresql.org/');
$text = '|<div id="pgFrontLatestReleasesWrap">(.*)</div>|Uis';
preg_match ($text, $subject, $matches);
$pattern = '|<b>(.*)</b>|Uis';
preg_match_all($pattern, $matches[1], $out);
//var_dump($out);
foreach($out[1] as $key => $version)
    echo $version . "\n";              
    
?>