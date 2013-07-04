<?php
$subject = file_get_contents('http://fortawesome.github.io/Font-Awesome/');
$text = '|<div class="shameless-self-promotion">.*version(.*)&n.*</div>|Uis';
preg_match ($text, $subject, $matches);
echo(trim($matches[1]));
echo("\n");
?>