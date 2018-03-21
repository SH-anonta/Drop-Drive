<?php

namespace utility\common{
	//return request url without the first root directory (for devolopment ease)
	function getRequestURI(){
		$url = $_SERVER['REQUEST_URI'];
		// cutoff the first '/'
		$url = explode('/', $url);
		$url = array_slice($url,2);
		$url = implode('/', $url);
		return $url;
	}

	function getPostData($key){
		return isset($_POST[$key])?  $_POST[$key] : '';
	}
	
	function getGetData($key){
		return isset($_POST[$key])?  $_POST[$key] : '';
	}

	function urlEncodePath($url){
		$parts = explode('/', $url);
		$encoded= array();

		foreach($parts as $p){
			$encoded[] = urlencode($p);
		}

		return implode('/', $encoded);
	}
}

?>