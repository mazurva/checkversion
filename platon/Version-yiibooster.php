<?php
$ch = curl_init ();
curl_setopt ($ch , CURLOPT_URL , "http://yiibooster.clevertech.biz/");
curl_setopt ($ch , CURLOPT_RETURNTRANSFER , 1 );
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
$content = curl_exec($ch);
curl_close($ch);
$text = '|<ul class="masthead-links">.*version(.*)</li>|Uis';
preg_match ($text, $content, $matches);
echo $matches[1];
echo "\n";
?>