<?php

require 'parfum.php';
require 'simple_html_dom.php';
require 'imgpar.php';
//-----------------------------

$obj = new Parfum;

$y = $obj->GetCategory();
$z = $obj->GetProduct();
//------------------------------

$subject = file_get_html('http://www.elite-parfume.ru/modules.php?name=Aromats');
foreach($subject->find('table[border=0] a') as $element) { 
    $x = $element->plaintext;
    $a = $element->href;
    similar_text($x, $y, $percent);
    if ($percent>=80) {
    	$category = $x;
    	$ssilka = $a;
    }
}
//echo $category . "\n" . $ssilka . "\n";
//---------------------------------------------

$subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka);
foreach($subject->find('table[border=0] a') as $element) { 
    $x = $element->plaintext;
    $a = $element->href;
    similar_text($x, $z, $percent);
    if ($percent>=60) {
    	$product = $x;
    	$ssilka = $a;
    }
}

//echo $product . "\n" . $ssilka . "\n";
//-----------------------------------------------
$subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka);
foreach($subject->find('table table table table table table table[border=0] img') as $element) {
	$im = $element->src;
	$image = new GetImage;
	$image->source = 'http://www.elite-parfume.ru/' . $im;
	$image->save_to = 'info/img/';

	$get = $image->download('curl');

	if($get)
	{
		echo 'Картинка сохранена' . "\n";
	}
}

$probel = "\n";
foreach($subject->find('table table table table table table[border=0]') as $element) {
	$info = $element->plaintext;
	$file = fopen ("info/img/info.txt","r+");
	if ( !$file ) { 
		echo("Ошибка открытия файла"); 
	} 
	else { 
		fputs ( $file, $category);
		fputs ( $file, $probel);
		fputs ( $file, $product);
		fputs ( $file, $probel);
		fputs ( $file, $info); 
		
	} 
	fclose ($file); 
}




?>