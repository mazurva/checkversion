<?php
    require('../parser/Version.php');
include('../parser/simple_html_dom.php');

$type = $_GET['type'];
$value = MyVersion::getClass($type, dirname(__FILE__).'/classes');
?>

Текущая версия 
            
    
        <?        
        $version = $value->getVersion() ;
        if(is_array($version)){
            ?>
            
            <ul class="unstyled">
            <?
            
            foreach ($version as $key => $v) {
                
                ?><li><?=$v?></li><?
            }   
            ?>
        </ul>
            <?    
        }else{
            echo $version ;
        }
        ?>
        
        <button class="btn btn-mini" onclick="js: $.get('library.php', {'type': '<?=get_class($value)?>'}, function(data){
            $(mybutton).parent().html(data);
        }); return false;" type="button">Обновить версию</button>