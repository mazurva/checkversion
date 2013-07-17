<?php
require('Parser.php');

class MyVersion extends Parser{
	
	protected $_parsePage = '';
	protected $_homePage = '';
	protected $_name = '';

	public function name(){
		return $this->_name;
	}

	public function __construct(){
		$this->url = $this->_parsePage;
	}

	public function homePage(){
		return $this->_homePage;
	}

	public function getVersion(){                             //получаем content из класса Parser
		return $this->content();
	}

	public static function version($className=__CLASS__){
		$obj = new $className(null);;
		return $obj->getVersion();
	}

	public static function getClasses($path){	
		$versions = array();
		$files = scandir($path);
		foreach ($files as $key => $value) {
			$pathFile = $path.'/'.$value;
			if(is_file($pathFile)){
				require($pathFile);
				$className =basename($value, ".php"); 	
				$version = new $className;
				$versions[] = $version;
			}
		}
		return $versions;
	}

	public static function getClass($name, $path) {
		$pathFile = $path.'/'.$name . ".php";
		
		if(is_file($pathFile)){
				require($pathFile);
				$className = $name; 	
				$version = new $className;
				$version->RewriteCache();
				return $version;
		}

		return false;
	}
}