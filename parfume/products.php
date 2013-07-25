<?php

require_once 'PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load("prays_dlya_sayta_2013.xls");
$objPHPExcel->setActiveSheetIndex(0);
    
$worksheetTitle = $objPHPExcel->getActiveSheet()->getTitle();
$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow(); 
$highestColumn = $objPHPExcel->getActiveSheet()->getHighestColumn(); 
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
$nrColumns = ord($highestColumn) - 64;
echo "В таблице ".$worksheetTitle." ";
echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
echo ' и ' . $highestRow . ' строк.';
        

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
    

?>