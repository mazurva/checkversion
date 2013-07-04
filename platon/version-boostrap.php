<?php
$subject = file_get_contents('http://twitter.github.io/bootstrap/');
$text = '|<ul class="masthead-links">.*Extend</a>.*<li>(.*)</li>|Uis';
preg_match ($text, $subject, $matches);
echo(trim($matches[1]));
//printf($matches[1]);
?>