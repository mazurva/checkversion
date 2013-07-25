<?php
require_once 'PHPExcel/IOFactory.php';

class Parfum{
    
    protected $highestColumn;
    protected $highestRow;
    protected $worksheetTitle;
    protected $objPHPExcel;
    protected $categoryRow;


    public function LoadExcelFile (){
        $this->objPHPExcel = PHPExcel_IOFactory::load("prays_dlya_sayta_2013.xls");
        $this->objPHPExcel->setActiveSheetIndex(0);
        return $this->objPHPExcel;
    }

    public function GetHighestRow () {
        $highestRow = $this->objPHPExcel->getActiveSheet()->getHighestRow();
        return $highestRow;
    }

    public function GetCategory () {
        $objPHPExcel = $this->LoadExcelFile();
        for ($row = 1; $row <= $this->GetHighestRow (); ++ $row){

            $col=1;

            $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            if (!$val==""){
                $category = $val;
                return $category;
                break 1;
            }
        }   
    }

    public function GetProduct () {
        $objPHPExcel = $this->LoadExcelFile();
        for ($row = 3; $row <= $this->GetHighestRow (); ++ $row){

            $col=2;

            $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            if (!$val==""){
                $product = $val;
                return $product;
                break 1;
            }
        }   
    }

}



?>