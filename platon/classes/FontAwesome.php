<?php
class FontAwesome extends MyVersion{
	public function __construct(){
		$this->_name = 'Font-Awesome';
		$this->_homePage = 'http://fortawesome.github.io/Font-Awesome/';
		$this->_parsePage = 'https://raw.github.com/FortAwesome/Font-Awesome/master/package.json';
		parent::__construct();
	}

	public function getVersion(){
		$content = parent::getVersion();
		$myarr = json_decode($content, true);
		return $myarr['version'];
	}
}
?>