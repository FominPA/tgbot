<?php
	define('TG_TOKEN', '7505622461:AAH8y1PWhOWNpkLab7BL9wuBxuBDvvE5Toc');
	define('MY_ID', '1852081635');
	$url = 'https://api.telegram.org/bot'. TG_TOKEN .'/sendMessage?chat_id=' . MY_ID . '&text=фром сервер';
	header('Location: ' . $url);
?>