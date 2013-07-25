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
    	if(!is_object($this->objPHPExcel))
    		$this->LoadExcelFile();
        $highestRow = $this->objPHPExcel->getActiveSheet()->getHighestRow();
        return $highestRow;
    }


    public function GetExcel ($row, $col) {
    	if(!is_object($this->objPHPExcel))
    		$this->LoadExcelFile();
    	$cell = $this->objPHPExcel->getActiveSheet()->getCellByColumnAndRow($col, $row);
        $val = $cell->getValue();
        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
    	return $val;
    }

    private function compareStringWithSinonium($str1, $str2){
        $maxp = 0;
        $sinonium = array(
            'men' => 'pour homme',
            'lady' => 'woman'
            );
        foreach ($sinonium as $key => $value) {
            $newstr2 = str_ireplace($key, $value, $str2);
            
            if($newstr2==$str2)
                continue;

            $maxp = $this->compareString($str1, $newstr2);

            $newstr2 = str_ireplace($value, $key, $str2);

            $maxp = max($this->compareString($str1, $newstr2), $maxp);

        }
        return $maxp==0?$this->compareString($str1, $str2):$maxp;
    }

    private function compareString($str1, $str2){        
        $dlina = max(strlen($str1), strlen($str2));
        $lev = max(levenshtein($str1, $str2), levenshtein($str2, $str1));
        similar_text($str1, $str2, $proc1);
        similar_text($str2, $str1, $proc2);
        $simular = max($proc1, $proc2);
        $lev = (1-$lev / $dlina)*100;
        return ($simular+$lev)/2;
    }

    public function GetInfoFromSite ($category, $product) {
    	$lev = "";
    	$maxlev = 70;
    	$file = fopen ("info/img/info.txt","r+");
    	$subject = file_get_html('http://www.elite-parfume.ru/modules.php?name=Aromats');
        //echo ("Это из эксэля: " . $category . "\n" . "\n");
    	foreach($subject->find('table table table table table table[border=0] a') as $element) { 
            $x = $element->plaintext;
            $a = $element->href;
            $levprocent = $this->compareString($x, $category);
            if ($levprocent>$maxlev){
            	$maxlev =$levprocent;
            	$ssilka = $a;
            }
        } 

        echo $ssilka . "\n\n";


        $subject = iconv( 'windows-1251', 'utf-8', file_get_contents('http://www.elite-parfume.ru/' . $ssilka));
        $maxlev = 0;
        echo ("Это из эксэля: " . $product . "\n" . "\n");
        //$obj = $subject->find('table table table table table');
        

        preg_match_all("|<td><a href='(.*)'>(.*)</a></td>|Uis", $subject, $obj);
        var_dump($subject);

        $ssilka1 = '';
    	foreach($obj as $element) { 
            $x = $element->plaintext;
            $x = strtolower($x);    
            $a = $element->href;
            $levprocent = $this->compareStringWithSinonium($x, $product);
            
            if ($levprocent>$maxlev){                
            	$maxlev =$levprocent;
            	$ssilka1 = $a;
            }
            echo $x . "\n";
            echo $levprocent . "\n";
            echo $maxlev . "\n";            
        }

        echo $ssilka1 . "\n";





      
        /*$subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka1);
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

        foreach($subject->find('table table table table table table[border=0]') as $element) {
            $info = $element->plaintext;                    
            if ( !$file ) { 
                echo("Ошибка открытия файла"); 
            } 
            else { 
                $probel = "\n";
                fputs ( $file, $info); 
                fputs ( $file, $probel);
                fputs ( $file, $probel);
                        
            } 
                     
        } fclose ($file);   */
    }












    public function GetAll () {
    	$file = fopen ("info/img/info.txt","r+");
    	$probel = "\n";
    	$ssilka = "";
    	$ssilka1 = "";
    	$lastproduct = "";
    	for ($row=1; $row<= $this->GetHighestRow (); ++ $row) { 

    		$col = 1;
    		$category =  $this->GetExcel ($row, $col);
    		if (!$category==""){
    			$subject = file_get_html('http://www.elite-parfume.ru/modules.php?name=Aromats');
    			foreach($subject->find('table[border=0] a') as $element) { 
                    $x = $element->plaintext;
                    $a = $element->href;
                    similar_text($x, $category, $percent);
                    if ($percent>=80) {
                        $ssilka = $a;
                    }
                }
    		}

    		$col=2;
    		$product =  $this->GetExcel ($row, $col);
    		$product = preg_replace('/\d+ml edT/Uis', '', $product);
            $product = trim($product);
    		if (!$product=="" and $product!=$lastproduct){
    			$lastproduct = $product;
    			$subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka);
    			foreach($subject->find('table[border=0] a') as $element) { 
                    $x = $element->plaintext;
                    $a = $element->href;
                    similar_text($x, $product, $percent);
                    if ($percent>=80) {
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
                        fputs ( $file, $info); 
                        fputs ( $file, $probel);
                        fputs ( $file, $probel);
                        
                    } 
                     
                }
    		}
    	} fclose ($file);
    }


}






?>