<?php

$way = '/var/www/checkversion/parser/cache/';
$filename = array();
$files = scandir($way);
//var_dump($files);
foreach ($files as $key => $value) {
	if(is_file('/var/www/checkversion/parser/cache/' . $value)){
		unlink('/var/www/checkversion/parser/cache/' . $value);
	}
}

include('../platon/version-all.php');

?>