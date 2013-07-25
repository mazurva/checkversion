<?php

require('../parser/Version.php');
require('../parser/simple_html_dom.php');
$versions = MyVersion::getClasses(dirname(__FILE__).'/classes');

$db = new SQLIte3('database');
if (!$db) die($error);

foreach ($versions as $value) {
	$version = $value->getVersion() ;
	if(is_array($version))
		$version = json_encode($version);
	
	$update1 = "UPDATE versions SET data_check = datetime('now') WHERE name = '{$value->name()}'";
	$ok1 = $db->exec($update1);
	$update1 = "UPDATE versions SET Version = '$version' WHERE name = '{$value->name()}'";
	$ok1 = $db->exec($update1);

	/*$stm1 = "INSERT INTO Versions VALUES('{$value->name()}', '$version', datetime('now'))";
	$ok1 = $db->exec($stm1);
	if (!$ok1) die("Cannot execute statement.");   */
	}

echo "Data inserted successfully \n";

?> 