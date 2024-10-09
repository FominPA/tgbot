<?php

	include_once 'SQLPublicRoots.php';

	define('TG_TOKEN', '7505622461:AAH8y1PWhOWNpkLab7BL9wuBxuBDvvE5Toc');

	class Listener {
		//$url = 'https://api.telegram.org/bot'. TG_TOKEN .'/getupdates';
		//$return = file_get_contents($url);
		public $last_update_id;

		function __construct (public $SQlUser) {
			$this->last_update_id = $this->load_last_update_id();
			for ( ;  ; ) { 
				$update = file_get_contents('https://api.telegram.org/bot'. TG_TOKEN .'/getupdates');
				if ($update->ok) {
					
				}
			})

		}

		function on() {
			while(1) {
				if ($return->ok) $this->check_update_id();
			}
		}

		function load_last_update_id() {
			$sql = 'SELECT * FROM `update_id_log` ORDER BY `date` DESC LIMIT 1;';
			$stmt = $this->SQLUser->pdo->query($sql);
			$result = $stmt->fetch();
			return $result[`id`];
		}

		function check_update_id() {

		}
	}
?>