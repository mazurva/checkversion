<html>
<head>
    <title>Текущие версии программ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" media="all" href="bootstrap/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" media="all" href="bootstrap/css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" media="all" href="bootstrap/css/bootstrap-responsive.css" />
<link type="text/css" rel="stylesheet" media="all" href="bootstrap/css/bootstrap-responsive.min.css" />
</head>    
<body>
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand">Текущие версии программ</a>
    <ul class="nav">
      <li><a href="#">Версии</a></li>
      <li><a href="#">Справка</a></li>
    </ul>
  </div>
</div>
<table border="1" class="table table-hover">
    <?php
    require('../parser/Version.php');
    //require('../parser/Parser.php');
include('../parser/simple_html_dom.php');
    $versions = MyVersion::getClasses(dirname(__FILE__).'/classes');

    foreach ($versions as $value) {
        ?>
        <tr>
        <td><h4><?=$value->name()?><br><a href="<?=$value->homePage()?>" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия 
            
    
        <?        
        $version = $value->getVersion() ;
        if(is_array($version)){
            ?>
            
            <ul class="unstyled">
            <?
            
            foreach ($version as $key => $value) {
                
                ?><li><?=$value?></li><?
            }   
            ?>
        </ul>
            <?    
        }else{
            echo $version ;
        }
        ?>
        
        <button class="btn btn-mini" type="button">Обновить версию</button>
        </td>
    </tr>
        <?
    }
    ?>
    

</table>


</body>
</html>