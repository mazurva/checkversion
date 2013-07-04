<?php
$subject = file_get_contents('http://twitter.github.io/bootstrap/');
$text = '|<ul class="masthead-links">.*Extend</a>.*<li>.*Version (.*)</li>|Uis';
preg_match ($text, $subject, $matches);
return (trim($matches[1]). "\n");
?>