<?php
class Bootstrap extends MyVersion{

	public function __construct(){
		$this->_name = 'Bootstrap';
		$this->_homePage = 'http://twitter.github.io/bootstrap/';
		$this->_parsePage = 'https://raw.github.com/twitter/bootstrap/master/package.json';
		parent::__construct();
	}

	public function getVersion(){
		$content = parent::getVersion();
		$myarr = json_decode($content, true);
		return $myarr['version'];
	}
}
?>