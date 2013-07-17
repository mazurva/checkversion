<?php
class Mysql extends MyVersion{
    
    public function __construct(){
	$this->_name = 'MySql';
	$this->_homePage = 'http://dev.mysql.com/downloads/';
	$this->_parsePage = 'http://dev.mysql.com/downloads/';
	parent::__construct();
    }

    public function getVersion(){
	$content = parent::getVersion();
	$text = '|<ul class="results noImage".*">.*MySQL Community Server.*Release:(.*)\)</span>|Uis';
        preg_match($text, $content, $matches);
	return ("\t" . $matches[1]);
    }
    
}
?>


