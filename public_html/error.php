<?php
	session_start();
	require_once __DIR__ . "/../vendor/autoload.php";

	$handler = new App\Handler();
	$err_code = App\Utilities::checkINT($_GET['code']);

	$handler->render([
		'tag'   => 'error',
		'title' => 'Error',
		'code'  => $err_code,
		'user'  => $handler->user->data
	]);
