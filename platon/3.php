<?php

$db = new SQLIte3('database');
if (!$db) die($error);

$result = sqlite_array_query($db, 'SELECT Name, Version, data_check FROM Versions LIMIT 25', SQLITE_ASSOC);
var_dump($result);



?>