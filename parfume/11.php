<?php

require 'all.php';
require 'duhi.php';
require 'imgpar.php';

$obj = new Parfum;

$excel = new Exel;
$objPHPExcel = $excel->LoadExcelFile();

$kolProducts=0;
$kolMen=0;
$kolLady=0;

$category = '';
$brand = '';

for ($row=3; $row <= $excel->GetHighestRow(); $row++) {
	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, $row);
	$val = trim($cell->getValue());
	if($val!=''){
		$brand = $val; 
	}
	$cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(2, $row);
	$val = trim($cell->getValue());
    $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
	if($val!=""){
		$sex = "";
    	//echo $val . "\n";
    	$kolProducts++;
        //------------------------------------
    	$name = strstr($val, 'men', true);
        $name1 = strstr($val, 'lady', true);
        $name2 = strstr($val, 'Lady', true);
        $name3 = strstr($val, 'woman', true);
        $name4 = strstr($val, 'Woman', true);
        $name5 = strstr($val, 'Her', true);
        $name6 = strstr($val, 'WOMAN', true);
        $name7 = strstr($val, 'Man', true);
        $name8 = strstr($val, 'homme', true);
        $name9 = strstr($val, 'Homme', true);
        $name10 = strstr($val, 'HOMME', true);
        $name11 = strstr($val, 'Him', true);
        $name12 = strstr($val, 'MEN', true);
        $name13 = strstr($val, ' MAN ', true);
        $name14 = strstr($val, ' man ', true);
        $name15 = strstr($val, 'ARMAND', true);
        //------------------------------------
    	if (!$name=="" or !$name7=="" or !$name8=="" or !$name9=="" or !$name10=="" or !$name11=="" or !$name12=="" or !$name13=="" or !$name14=="") {
        	$kolMen++;
            $sex = "man";
    	}
        
        /*if (!$name14=="" and $name3=="" and $name4=="") {
            $this->kolMen++;
        }*/


        //------------женская продукция-------------------
    	if (!$name1 == "" or !$name2 == "" or !$name3 == "" or !$name4 == "" or !$name6 == "") {
        	$kolLady++;
            $sex = "woman";
    	}
        
        if (!$name5 == "" and $name == "" and $name1 == "") {
            $kolLady++;
            $sex = "woman";
        }

        $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $row);
        $price = $cell->getValue();
        $price = is_numeric($price)?$price:0;

        $val = addslashes($val);

        if($sex == '')
            $sex = 'perfumery';

		$product = preg_replace('/\d+ml edT/Uis', '', $val);
		$product = preg_replace('/\d+ml edp/Uis', '', $product);
		$product = strtolower($product);
		$product = trim($product);    

		$res = $obj->GetInfoFromSite($brand, $product);

		if(isset($res[1])){
			foreach ($res[1] as $key => $image) {
				
				$getimage = new GetImage;
	            $getimage->source = $image;

	            $getimage->save_to = 'info/img/';

	            $get = $getimage->download('curl');

				$sql = "INSERT INTO `fleurdeparfum__good_image` (`image`, `good_id`) VALUES( '$image',
				(SELECT id FROM `fleurdeparfum__good` WHERE `name`='$val' AND `brand_id` = (SELECT `id` FROM `fleurdeparfum__brand` WHERE `name` LIKE '$brand')));\n";	
				echo $sql;		
				exit(0);
			}			
		} else {
			echo "# Не найден $val от $brand\n";
		}
        
	}
}

/*
$category = 'Calvin Klein';
$product = 'CALVIN KLEIN EUPHORIA Blossom lady  30ml edT ';
$product = preg_replace('/\d+ml edT/Uis', '', $product);
$product = preg_replace('/\d+ml edp/Uis', '', $product);
$product = strtolower($product);
$product = trim($product);

var_dump($obj->GetInfoFromSite($category, $product));
*/
?>