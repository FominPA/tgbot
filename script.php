<?php
	include_once 'BotSettings.php';

	//header('Location: ' . $url);
	$return = file_get_contents(BASE_URL . 'getMe');
	print_r($return);
?>