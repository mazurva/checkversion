<?php
class YiiBooster extends MyVersion{
	public function __construct(){
		$this->_name = 'Yii Booster';
		$this->_homePage = 'http://yiibooster.clevertech.biz/';
		$this->_parsePage = 'https://raw.github.com/clevertech/YiiBooster/master/build.properties';
		parent::__construct();
	}

	public function getVersion(){
		$content = parent::getVersion();
		$myarr = parse_ini_string($content);
		return $myarr['project.version'];
	}
}
/*
$content = Parser::load ("http://yiibooster.clevertech.biz/");
$text = '|<ul class="masthead-links">.*version (.*)</li>|Uis';
preg_match ($text, $content, $matches);
return ($matches[1] . "\n");
*/
?>