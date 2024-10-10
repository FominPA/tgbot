<?php
	include_once 'BotSettings.php';

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
		function __construct (private $UserID, private $Markup) {
			file_get_contents(
				BASE_URL .  'sendMessage?chat_id=' . $this->UserID . 
				'&text=keyboard sended' . 
				'&reply_markup=' . json_encode($this->Markup)
			);
		}
	} 
	
	
    // $SendOn = new SendMarkup(new RemoveKeyboard());
?>