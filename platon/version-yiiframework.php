<?php
$subject = file_get_contents('http://www.yiiframework.com/');
$text = '/<div class="version".*>.*<b.*>(.*)<\/b>(.*)<\/div>/';
preg_match ($text, $subject, $matches);
printf($matches[1]);
?>