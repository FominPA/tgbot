<?php 
	include_once "PDOUser.class.php";

	class SQLLoader {
		public $pdo;
		function __construct () {
			$SQLLoaderUser = new PDOUser('localhost', 'general', 'root', '');
			$this->pdo = $SQLLoaderUser->pdo;
		}
	} $localhostSQL = new SQLLoader();

	// Временно закину модел сейвер пока нет авторизации

	// class SQLModelSaver {
	// 	public $pdo;
	// 	function __construct () {
	// 		$SQLSaverUser = new PDOUser('localhost', 'k97732pj_general', 'k97732pj_general', 'S24072808ww');
	// 		$this->pdo = $SQLSaverUser->pdo;
	// 	}
	// } $bgSQL = new SQLModelSaver();
?>