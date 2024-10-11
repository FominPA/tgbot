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
		}
	}

	class CallBackData {
		function __construct (public $data) {}
	}

	class InlineKeyboard {
		function __construct (public $text, public $callback_data) {
			$this->callback_data = json_encode($this->callback_data);
		}
	}

	class InlineKeyboardMarkup {
		public $inline_keyboard;

		function __construct (private $matrix) {
			$this->inline_keyboard = $this->matrix;
		}
	}

	class SendMarkup {
		function __construct (private $UserID, private $Markup) {
			file_get_contents(
				BASE_URL .  'sendMessage?chat_id=' . $this->UserID . 
				'&text=keyboard sended' . 
				'&reply_markup=' . json_encode($this->Markup)
			);
		}
	}
?>