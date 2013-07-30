<?php
require_once 'PHPExcel/IOFactory.php';
class Exel
	{
		

    protected $highestColumn;
    protected $highestRow;
    protected $worksheetTitle;
    protected $kolLady = 0;
    protected $kolMen = 0;
    protected $kolProducts = 0;
    protected $kolCategory = 0;
    protected $kolUnname = 0;
    protected $objPHPExcel;


	public function LoadExcelFile (){
		$this->objPHPExcel = PHPExcel_IOFactory::load("prays_dlya_sayta_2013.xls");
        $this->objPHPExcel->setActiveSheetIndex(0);
        return $this->objPHPExcel;
	}



	/*public function GethighestCol() {
		$this->highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn();
		return $this->highestColumn;
	}*/

	public function GetHighestRow () {
        if(!isset($this->highestRow))
		  $this->highestRow = $this->objPHPExcel->getActiveSheet()->getHighestRow();
		return $this->highestRow;
	}

	/*public function GetTitle () {
		$this->worksheetTitle = $objPHPExcel->getActiveSheet()->getTitle();
		return $this->worksheetTitle;
	}
    */

	public function ShowAll () {
        $brand = '';
        $objPHPExcel = $this->LoadExcelFile();
        for ($row = 3; $row <= $this->GetHighestRow (); ++ $row)
        {
            for ($col = 1; $col <=2; ++ $col){
            
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $val = trim($cell->getValue());
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if ($col == 1) {
                	if (!$val=="") {
	                    $brand = $val;
	                    $this->kolCategory++;
                	}	
                }
                if ($col == 2) {
                	if (!$val=="") {
                        $sex = "";
                    	//echo $val . "\n";
                    	$this->kolProducts++;
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
                        	$this->kolMen++;
                            $sex = "man";
                    	}
                        
                        /*if (!$name14=="" and $name3=="" and $name4=="") {
                            $this->kolMen++;
                        }*/


                        //------------женская продукция-------------------
                    	if (!$name1 == "" or !$name2 == "" or !$name3 == "" or !$name4 == "" or !$name6 == "") {
                        	$this->kolLady++;
                            $sex = "woman";
                    	}
                        
                        if (!$name5 == "" and $name == "" and $name1 == "") {
                            $this->kolLady++;
                            $sex = "woman";
                        }

                        $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(3, $row);
                        $price = $cell->getValue();
                        $price = is_numeric($price)?$price:0;

                        $val = addslashes($val);

                        if($sex == '')
                            $sex = 'perfumery';

                        echo "INSERT INTO `fleurdeparfum__good` (`name`, `brand_id`, `category_id`, `price`) 
                        VALUES ('$val', (SELECT `id` FROM `fleurdeparfum__brand` WHERE `name` LIKE '$brand'),
                            (SELECT `id` FROM `fleurdeparfum__category` WHERE `alias` = '$sex'), $price);\n";
                        /*
                        echo "\n" . $val . "\n";
                        echo "Брэнд этого продукта: " . $brand . "\n";
                        if ($sex == ""){
                            echo "Этот товар не относится ни к женской категории, ни к мужской" . "\n";
                        }
                        elseif ($sex == "man") {
                            echo "Это мужской товар" . "\n";
                        }
                        elseif ($sex == "lady") {
                            echo "Это женский товар" . "\n";
                        }
                        */

                	}	
                }
            }


            
        }
        $this->kolUnname = $this->kolProducts - ($this->kolLady + $this->kolMen);
        echo ("\n" . "Количество категорий: " . $this->kolCategory . "\n");
        echo ("\n" . "Количество товара: " . $this->kolProducts . "\n");
        echo ("\n" . "Количество мужской продукции: " . $this->kolMen . "\n");
        echo ("\n" . "Количество женской продукции: " . $this->kolLady . "\n");
        echo ("\n" . "Количество прочей продукции: " . $this->kolUnname . "\n");
	}





	public function ShowCategories () {
        $objPHPExcel = $this->LoadExcelFile();
		$kolCategory = 0;
        for ($row = 1; $row <= $this->GetHighestRow(); ++ $row)
        {
            $col = 1; //считывается только столбец с категориями, т.е. столбец B
            
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if (!$val=="") {
                    //echo $val . "\n";
                    echo "INSERT INTO `fleurdeparfum__brand` (`name`) VALUES ('".$val."');\n";
                    $kolCategory++;
                }
            
        }
        echo ("\n" . "Количество категорий: " . $kolCategory . "\n");
	}		
	
	public function ShowAllProducts (){
		$kolProducts = 0;
		for ($row = 1; $row <= $highestRow; ++ $row)
        {
            $col = 2; //считывается только столбец с названием товара, т.е. столбец C
            
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if (!$val=="") {
                    //echo $val . "\n";
                    $kolProducts++;
                }
            
        }
        echo ("\n" . "Количество товара: " . $kolProducts . "\n");
	}

	public function ShowMensProducts (){
		$kolMen = 0;
        for ($row = 1; $row <= $highestRow; ++ $row)
        {
            $col = 2; //считывается только столбец с наименованием товаров, т.е. столбец C
            
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if (!$val=="") {
                    $name = strstr($val, 'men', true);
                    if (!$name == "") {
                        $kolMen++;
                    }
                    //echo $val . "\n";
                }
            
        }
        echo ("\n" . "Количество мужской продукции: " . $kolMen . "\n");
	}

	public function ShowLadysProducts (){
		$kolLady = 0;
        for ($row = 1; $row <= $highestRow; ++ $row)
        {
            $col = 2; //считывается только столбец с наименованием товаров, т.е. столбец C
            
                $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if (!$val=="") {
                    $name = strstr($val, 'lady', true);
                    if (!$name == "") {
                        $kolLady++;
                    }
                    //echo $val . "\n";
                }
            
        }
        echo ("\n" . "Количество женской продукции: " . $kolLady . "\n");
	}



	}



?>