<?php

	include_once 'SQLPublicRoots.php';

	define('TG_TOKEN', '7987115494:AAEeup0q0aPauEyRMfk9h8PtuImxHGbSo-Y');
	define('BASE_URL', 'https://api.telegram.org/bot'. TG_TOKEN .'/');
	define('MY_ID', '1852081635');

	class Listener {
		private $last_update_id;

		function __construct (public $SQLUser) {
			$this->last_update_id = $this->load_last_update_id();
			$update = json_decode(file_get_contents('https://api.telegram.org/bot'. TG_TOKEN .'/getupdates'));
			$last_el = count($update->result) - 1;
			
			if ($update->ok) {
				if ($update->result[$last_el] !== null && $update->result[$last_el]->update_id != $this->last_update_id ) {
					file_get_contents(BASE_URL . 'sendmessage?chat_id=' . MY_ID . '&text=new%20update%20id%20' . $update->result[$last_el]->update_id);
					
					$this->last_update_id = $update->result[$last_el]->update_id;
					$this->save_last_update_id();
				}
			}
		}

	// 	function on() {
	// 		while(1) {
	// 			if ($return->ok) $this->check_update_id();
	// 		}
	// 	}

		function load_last_update_id() {
			$sql = 'SELECT * FROM `update_id_log` ORDER BY `date` DESC LIMIT 1;';
			$stmt = $this->SQLUser->pdo->query($sql);
			$result = $stmt->fetch();
			return $result['id'];
		}

		function save_last_update_id() {
			$this->SQLUser->pdo->query('INSERT INTO `update_id_log` (id, date) VALUES (' . $this->last_update_id . ', default);');
		}

	} $listenerObj = new Listener($SQLModelSaver);

?>
