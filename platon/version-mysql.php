<?php
$homepage = file_get_contents('http://dev.mysql.com/downloads/');
$text = '|<ul class="results noImage".*">.*MySQL Community Server.*Release:(.*)\)</span>|Uis';
preg_match($text, $homepage, $matches);
//var_dump($matches[1]);
echo (trim($matches[1]));

//$text = '|<ul class="results noImage".*MySQL Community Server.*Release(.*)</span>|Uis';

?>


