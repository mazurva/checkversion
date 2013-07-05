<?php
class Parser{

	protected $url = '';
	private $content = '';

	public function __construct($url){
		$this->url = $url;
	}

	public function getSiteContent(){				
		$ch = curl_init ();		
		curl_setopt ($ch , CURLOPT_URL , $this->url);
		curl_setopt ($ch , CURLOPT_RETURNTRANSFER , 1 );
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
		$this->content = curl_exec($ch);						
		curl_close($ch);
		return $this->content;
	}

	public function content(){
		$this->getCache();
		return $this->content;
	}

	public static function load($url){
		$obj = new Parser($url);
		return $obj->content();
	}

	private function getCache(){
		$fileName = md5($this->url);
		$pathCache = dirname(__FILE__).'/cache/';

		if(!file_exists($pathCache))
			mkdir($pathCache);

		if(file_exists($pathCache.$fileName)){			
			if(time()-filemtime($pathCache.$fileName)<24*60*60){
				$this->content = file_get_contents($pathCache.$fileName);
			}
		}

		if($this->content=='')
			$this->setCache($pathCache.$fileName);

		return $this->content;
	}

	private function setCache($fileName){
		file_put_contents($fileName, $this->getSiteContent());
	}
}