<?php
require_once 'PHPExcel/IOFactory.php';
require 'simple_html_dom.php';
require 'imgpar.php';
class Parfum{
    
    protected $highestRow;
    protected $objPHPExcel;


    public function LoadExcelFile (){
        $this->objPHPExcel = PHPExcel_IOFactory::load("prays_dlya_sayta_2013.xls");
        $this->objPHPExcel->setActiveSheetIndex(0);
        return $this->objPHPExcel;
    }

    public function GetHighestRow () {
        $highestRow = $this->objPHPExcel->getActiveSheet()->getHighestRow();
        return $highestRow;
    }

    public function GetAll () {
        $file = fopen ("info/img/info.txt","r+");
        $ssilka = "";
        $ssilka1 = "";
        $product = "";
        $objPHPExcel = $this->LoadExcelFile();
        for ($row = 1; $row <= $this->GetHighestRow (); ++ $row){

            $col=1;

            $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            
            if (!$val==""){
                $category = $val;
                $subject = file_get_html('http://www.elite-parfume.ru/modules.php?name=Aromats');
                foreach($subject->find('table[border=0] a') as $element) { 
                    $x = $element->plaintext;
                    $a = $element->href;
                    similar_text($x, $category, $percent);
                    if ($percent>=80) {
                        $category = $x;
                        $ssilka = $a;
                    }
                }
            }

            

            $col=2;

            $cell = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            
            $val = preg_replace('/\d+ml edT/Uis', '', $val);
            $val = trim($val);

            if (!$val=="" and $val!=$product){
                $product = $val;
                $subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka);
                foreach($subject->find('table[border=0] a') as $element) { 
                    $x = $element->plaintext;
                    $a = $element->href;
                    similar_text($x, $product, $percent);
                    if ($percent>=80) {
                        //$product = $x;
                        $ssilka1 = $a;
                    }
                }

                $subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka1);
                foreach($subject->find('table table table table table table table[border=0] img') as $element) {
                    $im = $element->src;
                    $image = new GetImage;
                    $image->source = 'http://www.elite-parfume.ru/' . $im;
                    $image->save_to = 'info/img/';

                    $get = $image->download('curl');

                    if($get)
                    {
                        echo $row . "\n";
                        echo 'Картинка сохранена' . "\n";
                    }
                }
                foreach($subject->find('table table table table table table[border=0]') as $element) {
                    $info = $element->plaintext;
                    
                    if ( !$file ) { 
                        echo("Ошибка открытия файла"); 
                    } 
                    else { 
                        $probel = "\n";
                        //fputs ( $file, $category);
                        //fputs ( $file, $probel);
                        //fputs ( $file, $product);
                        //fputs ( $file, $probel);
                        fputs ( $file, $info); 
                        fputs ( $file, $probel);
                        fputs ( $file, $probel);
                        
                    } 
                     
                }   
            } 
        }   fclose ($file);
    }
}



?>