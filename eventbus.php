<?php
	include_once 'botsettings.php';
	include_once 'buttons.php';
	include_once 'ConcreteArticle.php';

	class EventBus {

		function __construct (private $Query) {

			if (!is_null($this->Query->message)) {
				switch ($this->Query->message->text) {
					case '/start':
						$this->open_general_menu($this->Query->message->from->id);
					break;

					case 'Каталог':
						$LifePo4 = new LifePo4GeneralArticle($this->Query);  $LifePo4->general($this->Query);
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
				echo 'data: ' . $this->Query->callback_query->data;

				switch ($this->Query->callback_query->data) {
					case '"general"':
						$LifePo4 = new LifePo4GeneralArticle($this->Query);  $LifePo4->back_to_general($this->Query);
						break;

					case '"feature"':
						$LifePo4 = new LifePo4GeneralArticle($this->Query);  $LifePo4->feature($this->Query);
						break;

					case '"spec"':
						$LifePo4 = new LifePo4GeneralArticle($this->Query);  $LifePo4->spec($this->Query);
						break;

					case '"callmanager"':
						
						break;
					
					default:
						
						break;
				}
			}
		}

		function open_general_menu($UserID) {
			$GeneralKeyboard= new KeyboardMarkup([
				[new KeyboardButton('Каталог')],
				[new KeyboardButton('Контакт продавца')],
				[new KeyboardButton('Закрыть клавиатуру')]
			]);
			$SendOn = new SendMarkup($UserID, $GeneralKeyboard);
		}

		function close_keyboard($UserID) {
			$SendOn = new SendMarkup($UserID, new RemoveKeyboard());
		}
	}
?>