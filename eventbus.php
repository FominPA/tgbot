<?php
	include_once 'botsettings.php';
	include_once 'buttons.php';
	include_once 'Catalog.php';

	class EventBus {

		function __construct (private $Query) {

			if (!is_null($this->Query->message)) {
				switch ($this->Query->message->text) {
					case '/start':
						$this->open_general_menu($this->Query->message->from->id);
					break;

					case 'Каталог':
						$SendCatalog = new Catalog($this->Query);
					break;

					case 'Контакт продавца':
						file_get_contents(BASE_URL . 'sendcontact?chat_id=' . $this->Query->message->from->id . '&first_name=Никита&last_name=Гифрин&phone_number=79257393984');
					break;

					case 'Закрыть клавиатуру':
						$this->close_keyboard($this->Query->message->from->id);
					break;
					
					default:
						echo 'pass';
					break;
				};
			}


			if (!is_null($this->Query->callback_query)) {
				if ( stripos($this->Query->callback_query->data, 'editarticle') ) $SendCatalog = new Catalog($this->Query);
			}
		}

		function open_general_menu($UserID) {
			$GeneralKeyboard = new KeyboardMarkup([
				[new KeyboardButton('Каталог')],
				[new KeyboardButton('Контакт продавца')],
				[new KeyboardButton('Закрыть клавиатуру')]
			]);
			$SendOn = new SendMarkup($UserID, $GeneralKeyboard);

			file_get_contents(
				BASE_URL .  'deleteMessage?chat_id=' . $UserID . 
				'&message_id=' . $SendOn->exe->result->message_id-1
			);
		}

		function close_keyboard($UserID) {
			$SendOn = new SendMarkup($UserID, new RemoveKeyboard());

			file_get_contents(
				BASE_URL .  'deleteMessage?chat_id=' . $UserID . 
				'&message_id=' . $SendOn->exe->result->message_id
			);

			file_get_contents(
				BASE_URL .  'deleteMessage?chat_id=' . $UserID . 
				'&message_id=' . $SendOn->exe->result->message_id-1
			);
		}
	}
?>