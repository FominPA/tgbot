<?php

	include_once 'SQLPublicRoots.php';

	define('TG_TOKEN', '7505622461:AAH8y1PWhOWNpkLab7BL9wuBxuBDvvE5Toc');
	define('BASE_URL', 'https://api.telegram.org/bot'. TG_TOKEN .'/');
	define('MY_ID', '1852081635')

	class Listener {
		//$url = 'https://api.telegram.org/bot'. TG_TOKEN .'/getupdates';
		//$return = file_get_contents($url);
		private $last_update_id;

		function __construct (public $SQlUser) {
			$this->last_update_id = $this->load_last_update_id();
			for ( ;  ; ) { 

				$update = file_get_contents('https://api.telegram.org/bot'. TG_TOKEN .'/getupdates');

				if ($update->ok) {
					if ($update->result['1'] !== null || $update->result['1']->update_id !== $this->last_update_id) {
						file_get_contents(BASE_URL . 'sendmessage?chat_id=' . MY_ID . 'text=new update id ' . $update->result['1']->update_id );
						$this->last_update_id = $update->result['1']->update_id;
						$this->save_last_update_id();
					}
				}
			})

		}/*

		function on() {
			while(1) {
				if ($return->ok) $this->check_update_id();
			}
		}*/

		function load_last_update_id() {
			$sql = 'SELECT * FROM `update_id_log` ORDER BY `date` DESC LIMIT 1;';
			$stmt = $this->SQLUser->pdo->query($sql);
			$result = $stmt->fetch();
			return $result[`id`];
		}

		function save_last_update_id() {
			$this->SQLUser->pdo->query('INSERT INTO `update_id_log` (id = ' . $this->last_update_id . ');');
		}

		/*

		function check_update_id() {

		}*/
	} $listenerObj = new Listener($SQLModelSaver);
?>