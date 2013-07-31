<?php
//require_once 'PHPExcel/IOFactory.php';
require 'simple_html_dom.php';


class Parfum{

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
        $ssilka = '';
    	$lev = "";        
    	$maxlev = 70;
    	//$file = fopen ("info/img/info.txt","rw+");
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

        if($ssilka=='')return ; 
        //echo $ssilka . "\n\n";
        $url = $this->unparse_url(parse_url('http://www.elite-parfume.ru/' . $ssilka));

        $subject = iconv( 'windows-1251', 'utf-8', file_get_contents($url));

        $maxlev = 0;
        //echo ("Это из эксэля: " . $product . "\n" . "\n");
        //$obj = $subject->find('table table table table table');
        
        $subject = str_replace('</tr>', "</tr>\n", $subject);

        preg_match_all("|<td><a href='(.*)'>(.*)<\/a><\/td>|Uism", $subject, $obj);

        foreach ($obj[2] as $key => $value) {
            if(preg_match("|<td><a href='(.*)'>(.*)|", $value, $newobj)>0){                
                $obj[1][$key] = $newobj[1];
                $obj[2][$key] = $newobj[2];
            }                
        }

        $ssilka1 = '';
        
    	foreach($obj[2] as $key => $element) { 
            $x = $element;
            $x = strtolower($x);    
            $a = $obj[1][$key];
            $levprocent = $this->compareStringWithSinonium($x, $product);
            
            if ($levprocent>$maxlev){                
            	$maxlev =$levprocent;                
            	$ssilka1 = $a;
            }
            //echo $x . "\n";
            //echo $levprocent . "\n";
            //echo $maxlev . "\n";            
        }

        if($ssilka1=='') return ;
        //echo 'http://www.elite-parfume.ru/' . $ssilka1 . "\n";
      
        $subject = file_get_html('http://www.elite-parfume.ru/' . $ssilka1);

        $image = array();
        
        foreach($subject->find('table table table table table table table[border=0] img') as $element) {
            $im = $element->src;
            $image []= 'http://www.elite-parfume.ru/' . $im;
            /*$image = new GetImage;
            $image->source = 'http://www.elite-parfume.ru/' . $im;
            $image->save_to = 'info/img/';

            $get = $image->download('curl');

            if($get)
            {
                echo 'Картинка сохранена' . "\n";
            }*/
        }
        
        //foreach($subject->find('table table table table table table[border=0]') as $element) {
            $info = $subject->find('table table table table table table table', 0);    
            if(trim($info->plaintext)==''){
                return array("Описание временно отсутсвует", $image);    
            }
            return array(nl2br($info->plaintext), $image);
            /*                
            if ( !$file ) { 
                echo("Ошибка открытия файла"); 
                return ;
            } 
            else { 
                $probel = "\n";
                fputs ( $file, $info); 
                fputs ( $file, $probel);
                fputs ( $file, $probel);
                        
            } 
            */
                     
        //} 
        //fclose ($file);   
    }





    private function unparse_url($parsed_url) { 
      $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
      $host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
      $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
      $user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
      $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
      $pass     = ($user || $pass) ? "$pass@" : ''; 
      $path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
      $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
      $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 
      return str_replace(' ', '+', "$scheme$user$pass$host$port$path$query$fragment"); 
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