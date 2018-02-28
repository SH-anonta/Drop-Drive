<?php
	require_once('router.php');
	require_once('utility/common.php');

	// IMPORTANT: first / is skipped only for development ease
	
	$uri = \utility\common\getRequestURI();
	$controller = Router::resolveUrl($uri);
	
	$request_method = $_SERVER['REQUEST_METHOD'];
	if($request_method == 'GET'){
		$controller::get();
	}
	else if($request_method == 'POST'){
		$controller::post();
	}
?>
