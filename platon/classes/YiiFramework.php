<?php
class YiiFramework extends MyVersion{
	public function __construct(){
		$this->_name = 'Yii Framework';
		$this->_homePage = 'http://www.yiiframework.com';
		$this->_parsePage = 'https://raw.github.com/yiisoft/yii/master/framework/yiilite.php';
		parent::__construct();
	}

	public function getVersion(){
		return eval(str_replace(array('<?php', '?>'), '', parent::getVersion()).' return YiiBase::getVersion();');
	}
}
/*
$subject = Parser::load('http://www.yiiframework.com/');
$text = '/<div class="version".*>.*v(.*)<\/b>/';
preg_match ($text, $subject, $matches);
return($matches[1] . "\n");
*/
?>