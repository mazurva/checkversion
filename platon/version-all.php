<?php
require('../parser/Version.php');
require('../parser/simple_html_dom.php');

$versions = MyVersion::getClasses(dirname(__FILE__).'/classes');

foreach ($versions as $value) {
	echo $value->name() . "\t-\t";
	$version = $value->getVersion() ;
	if(is_array($version)){
		$first = true;
		foreach ($version as $key => $value) {
			if($first){
				echo "\t";	
				$first=false;
			}else
				echo "\t\t\t";
			echo $value."\n";
		}		
	}else{
		echo $version . "\n";
	}
}
/*
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
    
*/    
?>