<?php
	include_once 'BotSettings.php';

	//header('Location: ' . $url);
	$return = file_get_contents(BASE_URL . 'setmyname?name=test store bot');
	print_r($return);
?>