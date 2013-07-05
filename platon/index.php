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
<table border="1" class="table table-hover">
    <tr>
        <td><h4>Bootstrap<br><a href="http://twitter.github.io/bootstrap" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия -
            <?php
require('parser/Parser.php');
$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-bootstrap.php');
echo "$bootstrap";?>
        </td>
    </tr>
      <tr>
        <td><h4>Font-Awesome<br><a href="http://fortawesome.github.io/Font-Awesome/" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия - 
            <?php

$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-fontawesome.php');
echo "$bootstrap";?>
        </td>
    </tr>
      <tr>
        <td><h4>MySQL<br><a href="http://mysql.com" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия - 
            <?php

$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-mysql.php');
echo "$bootstrap";?>
        </td>
    </tr>
      <tr>
        <td><h4>YiiBooster<br><a href="http://yiibooster.clevertech.biz/" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия - 
            <?php

$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-yiibooster.php');
echo "$bootstrap";?>
        </td>
    </tr>
      <tr>
        <td><h4>Yiiframework<br><a href="http://yiiframework.com" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td>Текущая версия - 
            <?php

$path = dirname(__FILE__);
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-yiiframework.php');
echo "$bootstrap";?>
        </td>
    </tr>
      <tr>
        <td><h4>PHP<br><a href="http://php.net" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td> <ul class="unstyled">
        <?php
    
$path = dirname(__FILE__);
$ver = 'Текущая версия - ';
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-php.php');
foreach($out[1] as $key => $version){
    ?>
    <li><?=$ver,$version?></li>
    <?
}
        ?>        
        </ul>
        </td>
    </tr>
    <tr>
        <td><h4>PostgreSQL<br><a href="http://www.postgresql.org/" class="btn btn-success" onclick="return !window.open(this.href)">Перейти на сайт</a></h4>
        </td>
        <td> <ul class="unstyled">
        <?php
   
$path = dirname(__FILE__);
$ver = 'Текущая версия - ';
$bootstrap = require($path . DIRECTORY_SEPARATOR . 'version-postgresql.php');
foreach($out[1] as $key => $version){
    ?>
    <li><?=$ver,$version?></li>
    <?
}
        ?>        
        </ul>
        </td>
    </tr>
</table>


</body>
</html>