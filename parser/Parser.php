<?php
class Parser{

	private $url = '';
	private $content = '';

	public function __construct($url){
		$this->url = $url;
	}

	public function getSiteContent(){				 // берется html код с помощью curl
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

	public static function load($url){                    // эта функция пишется в других файлах
		$obj = new Parser($url);                      // для выхова данного класса
		return $obj->content();
	}

	private function getCache(){
		$fileName = md5($this->url);                   // хэширование
		$pathCache = dirname(__FILE__).'/cache/';      // путь к файлу в папке cache

		if(!file_exists($pathCache))                   // если папка не существует
			mkdir($pathCache);                     //создадим его

		if(file_exists($pathCache.$fileName)){		                           //если файл существует	
			if(time()-filemtime($pathCache.$fileName)<24*60*60){               //проверка на время создания
				$this->content = file_get_contents($pathCache.$fileName);  //взять html код из файла
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