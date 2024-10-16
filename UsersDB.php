<?php
	include_once 'SQLPublicRoots.php';

	class UsersDB {

		function __construct (private $SQL, private $Query) {
			if (!$this->is_have($this->Query->message->from->id)) $this->add_user($this->Query->message->from);
		}

		function create_table() {
			$sql = 'CREATE TABLE `users` ( `user_id` INT UNSIGNED );';
			$this->SQL->pdo->query($sql);
		}

		function get_users() {
			$sql = 'SELECT `user_id` FROM `users` WHERE 1;';
			return $this->SQL->pdo->query($sql)->fetchAll();
		}

		function is_have($UserID) {
			foreach ($this->get_users() as $value) {
				if ( $value['user_id'] == $UserID ) return true;
			} return false;
		}

		function add_user($from) {
			$sql = 'INSERT INTO `users` (`user_id`, `user_login`) VALUES (:userid, :login);';
			$stmt = $this->SQL->pdo->prepare($sql);
			$stmt->execute([':userid' => $from->id, ':login' => $from->username]);
		}
	}
?>