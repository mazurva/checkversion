<?php

$subject = Parser::load('http://twitter.github.io/bootstrap/');
$text = '|<ul class="masthead-links">.*Extend</a>.*<li>.*Version (.*)</li>|Uis';
preg_match ($text, $subject, $matches);
return (trim($matches[1]));
?>