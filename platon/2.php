<?php

$db = new SQLIte3('database');
if (!$db) die($error);

$stm1 = "INSERT INTO Versions VALUES('jane', 5.3, 'data')";
$ok1 = $db->exec($stm1);

if (!$ok1) die("Cannot execute statement.");
	
echo "Data inserted successfully \n";


?>