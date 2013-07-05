<?php
require('../parser/Parser.php');

$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-bootstrap.php');
echo "$bootstrap";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-fontawesome.php');
echo "$bootstrap";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-mysql.php');
echo "$bootstrap";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-yiibooster.php');
echo "$bootstrap";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-yiiframework.php');
echo "$bootstrap";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-php.php');
//echo "$bootstrap";
foreach($out[1] as $key => $version)
    echo $version."\n";

$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-postgresql.php');
//echo "$bootstrap";
foreach($out[1] as $key => $version)
    echo $version."\n";    
    
    
?>