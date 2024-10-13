<?php

	include_once 'SQLPublicRoots.php';

	include_once 'BotSettings.php';

	include_once 'eventbus.php';

	class Listener {
		private $last_update_id;

		function __construct (public $SQLUser) {
			$this->last_update_id = $this->load_last_update_id();
			$update = json_decode(file_get_contents(BASE_URL .'getupdates'));
			$last_el = count($update->result) - 1;
			echo $this->last_update_id . '<br>';
			var_dump($update->result[$last_el]);

			if ($update->ok) {
				if ($update->result[$last_el] !== null && $update->result[$last_el]->update_id > $this->last_update_id ) {
					file_get_contents(
					'https://api.telegram.org/bot' . '7987115494:AAEeup0q0aPauEyRMfk9h8PtuImxHGbSo-Y/'
					. 'sendmessage?chat_id=' . MY_ID . '&text=new%20update%20id%20' . $update->result[$last_el]->update_id);

					for ($i=$last_el; $update->result[$i]->update_id > $this->last_update_id; $i--) 
						$Event = new EventBus($update->result[$i]);
					
					$this->last_update_id = $update->result[$last_el]->update_id;
					$this->save_last_update_id();
				}
				echo("<meta http-equiv='refresh' content='1'>");
			}
		}

		function load_last_update_id() {
			$sql = 'SELECT * FROM `update_id_log` ORDER BY `date` DESC LIMIT 1;';
			$stmt = $this->SQLUser->pdo->query($sql);
			$result = $stmt->fetch();
			return $result['id'];
		}

		function save_last_update_id() {
			$this->SQLUser->pdo->query('INSERT INTO `update_id_log` (id, date) VALUES (' . $this->last_update_id . ', default);');
		}
	} $listenerObj = new Listener($localhostSQL);

?>
