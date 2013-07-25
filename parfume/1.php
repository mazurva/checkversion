<?php

require 'duhi.php';

$obj = new Parfum;

$category = 'Calvin Klein';
$product = 'CALVIN KLEIN EUPHORIA Blossom lady  30ml edT ';
$product = preg_replace('/\d+ml edT/Uis', '', $product);
$product = preg_replace('/\d+ml edp/Uis', '', $product);
$product = strtolower($product);
$product = trim($product);

$obj->GetInfoFromSite($category, $product);

?>