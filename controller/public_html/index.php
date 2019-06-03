<?php
	require_once __DIR__ . "/../vendor/autoload.php";
	
	$enviro = new \App\Model\Environment();
	$render = new \App\Controller\Render([
		'tag'  => 'home'
	]);
	$render->twigRender();
	