<?php

$content = Parser::load ("http://yiibooster.clevertech.biz/");
$text = '|<ul class="masthead-links">.*version (.*)</li>|Uis';
preg_match ($text, $content, $matches);
return ($matches[1] . "\n");
?>