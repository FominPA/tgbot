<?php
	include_once 'botsettings.php';
	include_once 'buttons.php';

	class EventBus {
		function __construct (private $Query) {
			$UserID = $this->Query->message->from->id;
			echo 'UserID: ' . $UserID . '<br>';
			echo 'Text: ' . $this->Query->message->text . '<br>';

			switch ($this->Query->message->text) {
				case '/start':
					$this->open_general_menu($UserID);
				break;

				case 'Каталог':
					// $this->close_keyboard($UserID);
				break;

				case 'Связаться с менеджером':
					file_get_contents(BASE_URL . 'sendcontact?chat_id=' . $UserID . '&first_name=Никита&last_name=Гифрин&phone_number=79257393984');
				break;

				case 'Закрыть клавиатуру':
					$this->close_keyboard($UserID);
				break;
				
				default:
					echo 'pass';
				break;
			}
		}

		function open_general_menu($UserID) {
			$GeneralKeyboard= new KeyboardMarkup([
				[new KeyboardButton('Каталог')],
				[new KeyboardButton('Связаться с менеджером')],
				[new KeyboardButton('Закрыть клавиатуру')]
			]);
			$SendOn = new SendMarkup($UserID, $GeneralKeyboard);
		}

		function close_keyboard($UserID) {
			$SendOn = new SendMarkup($UserID, new RemoveKeyboard());
		}
	}
?>