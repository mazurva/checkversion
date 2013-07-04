<?php

$homepage = Parser::load('http://dev.mysql.com/downloads/');
$text = '|<ul class="results noImage".*">.*MySQL Community Server.*Release:(.*)\)</span>|Uis';
preg_match($text, $homepage, $matches);
return (trim($matches[1]). "\n");

?>


