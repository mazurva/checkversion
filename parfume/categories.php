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
        $kolCategory = 0;
        for ($row = 1; $row <= $highestRow; ++ $row)
        {
            $col = 1; //считывается только столбец с категориями, т.е. столбец B
            
                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                if (!$val=="") {
                    //echo $val . "\n";
                    $kolCategory++;
                }
            
        }
        echo ("\n" . "Количество категорий: " . $kolCategory . "\n");
    }

    ?>