<?php
$email  = 'firstsecond';
$domain = strstr($email, 'men');
echo ($domain . "\n"); // выводит @example.com

$user = strstr($email, 'men', true); // Начиная с PHP 5.3.0
echo ($user . "\n"); // выводит name
?>
