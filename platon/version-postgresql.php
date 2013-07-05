<?php
class Php extends MyVersion{
	
	public function __construct(){
		$this->_name = 'PHP';
		$this->_homePage = 'http://www.php.net/';
		$this->_parsePage = 'https://raw.github.com/php/web-php/master/include/version.inc';
		parent::__construct();
	}

	public function getVersion(){
		$val = eval(str_replace('<?php', '', parent::getVersion().' return $RELEASES[5];'));
		return array_keys($val);
	}
}







/*$subject = Parser::load('http://www.postgresql.org/');
$text = '|<div id="pgFrontLatestReleasesWrap">(.*)</div>|Uis';
preg_match ($text, $subject, $matches);
$pattern = '|<b>(.*)</b>|Uis';
preg_match_all($pattern, $matches[1], $out);
//var_dump($out);
//foreach($out[1] as $key => $version)
    //echo $version . "\n";              
    return ($out[1]);
*/
?>