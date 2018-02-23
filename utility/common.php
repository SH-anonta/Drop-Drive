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
}

?>