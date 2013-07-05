<?php

$subject = Parser::load('http://www.yiiframework.com/');
$text = '/<div class="version".*>.*v(.*)<\/b>/';
preg_match ($text, $subject, $matches);
return($matches[1] . "\n");
?>