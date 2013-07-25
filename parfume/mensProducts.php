    <?php

    require_once 'PHPExcel/IOFactory.php';
    $objPHPExcel = PHPExcel_IOFactory::load("prays_dlya_sayta_2013.xls");
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
    {
        $worksheetTitle = $worksheet->getTitle();
        $highestRow = $worksheet->getHighestRow(); 
        $highestColumn = $worksheet->getHighestColumn(); 
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;
        echo "В таблице ".$worksheetTitle." ";
        echo $nrColumns . ' колонок (A-' . $highestColumn . ') ';
        echo ' и ' . $highestRow . ' строк.';
        $kolMen = 0;
        for ($row = 1; $row <= $highestRow; ++ $row)
        {
            $col = 2; //считывается только столбец с наименованием товаров, т.е. столбец C
            
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
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

    ?>
