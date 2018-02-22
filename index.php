<?php
	require_once('router.php');

	// IMPORTANT: first / is skipped only for development ease
	function getURI(){
		$url = $_SERVER['REQUEST_URI'];
		// cutoff the first '/'
		$url = explode('/', $url);
		$url = array_slice($url,2);
		$url = implode('/', $url);
		return $url;
	}
	
	$uri = getURI();
	$controller = Router::resolveUrl($uri);
	
	$request_method = $_SERVER['REQUEST_METHOD'];
	if($request_method == 'GET'){
		$controller::get()[0];
	}
	else if($request_method == 'POST'){
		$controller::post()[0];
	}
	
?>
