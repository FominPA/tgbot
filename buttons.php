<?php
	define('TG_TOKEN', '7987115494:AAEeup0q0aPauEyRMfk9h8PtuImxHGbSo-Y');
	define('BASE_URL', 'https://api.telegram.org/bot'. TG_TOKEN .'/');
	define('MY_ID', '1852081635');

	class KeyboardButton {
		function __construct (public $text) {}
	}
	
	class RemoveKeyboard {
	    public $remove_keyboard = true;
	}

	class KeyboardMarkup {
		public $keyboard;
		public $resize_keyboard = false;

		function __construct (private $matrix) {
			$this->keyboard = $this->matrix;
			$this->resize_keyboard = true;
		}
		
	}

    $ReplyKeyboardMarkup = new KeyboardMarkup(
        [
            [new KeyboardButton('Левая Верхняя'), new KeyboardButton('Правая Верхняя')],
            [new KeyboardButton('Левая'), new KeyboardButton('Правая')],
            [new KeyboardButton('Левая Нижняя'), new KeyboardButton('Правая Нижняя')]
        ]
    );

	class SendMarkup {
		function __construct (private $Markup) {
			file_get_contents(
				BASE_URL .  'sendMessage?chat_id=' . MY_ID . 
				'&text=keyboard sended' . 
				'&reply_markup=' . json_encode($this->Markup)
			);
		}
	} 
	
	
    $SendOn = new SendMarkup($ReplyKeyboardMarkup);
?>