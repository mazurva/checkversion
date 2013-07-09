<?php

class Postgresql extends MyVersion{

	public function __construct(){
		$this->_name = 'Postgresql';
		$this->_homePage = 'http://www.postgresql.org/';
		$this->_parsePage = 'http://www.postgresql.org/';
		parent::__construct();
	}

	public function getVersion(){
		$subject = str_get_html(Parser::load('http://www.postgresql.org/'));
		$res=array();
		foreach ($subject->find('div[id=pgFrontLatestReleasesWrap] b') as $key => $value) {
		$res []= $value->plaintext;
		}
		return $res;
	}
}

?>
