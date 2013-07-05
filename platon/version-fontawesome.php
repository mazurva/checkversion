<?php
$subject = Parser::load('http://fortawesome.github.io/Font-Awesome/');
$text = '|<div class="shameless-self-promotion">.*version(.*)&n.*</div>|Uis';
preg_match ($text, $subject, $matches);
return (trim($matches[1]). "\n");
?>