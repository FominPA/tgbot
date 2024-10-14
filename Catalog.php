<?php
	include_once 'buttons.php';
	include_once 'Articles/BMSDaly.php';
	include_once 'Articles/LifePo420Ah.php';
	include_once 'Articles/YZPower.php';

	class Catalog {
		function __construct ($Query) {
			$this->send($Query);
		}

		function send($Query) {
			$Article = new LifePo420Ah($Query);
			$Article = new BMSDaly($Query);
			$Article = new YZPower($Query);
		}
	}
?>