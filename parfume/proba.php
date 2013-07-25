<?php



/*$var_1 = 'ANTONIO BANDERAS Blue Seduction  men  50ml edT  ';
echo $var_1 . "\n";
$var_2 = 'BLUE FRESH SEDUCTION men';

$var_1 = preg_replace('/\d+ml edT/Uis', '', $var_1);
$var_1 = trim($var_1);
$dlina = max(strlen($var_2), strlen($var_1));
$lev = levenshtein($var_1, $var_2);
$levprocent = (1-$lev / $dlina)*100;

echo $var_1;
echo "\n";
echo $var_2;
echo "\n";
echo $levprocent;
echo "\n";
echo "\n";
echo "\n";*/



$excel = 'dior fahrenheit  men';
echo $excel . "\n";
$var_2 = 'fahrenheit 32 men';
echo $var_2 . "\n";
similar_text($excel, $var_2, $percent); 
echo $percent;
echo "\n\n";



$var_3 = 'aqua fahrenheit men';
echo $excel . "\n";
echo $var_3 . "\n";
similar_text($excel, $var_3, $percent); 
echo $percent;
echo "\n\n";
?>