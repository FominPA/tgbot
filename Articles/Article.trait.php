<?php
	interface iArticle {
		function concrete_init();
		function set_photo();
		function set_general_text();
		function set_general_markup();
		function concrete_eventbus($Query, $data);
	}

	trait AbstructArticle {
		public $edit_query = 'editarticle';

		function __construct (public $Query) {

			$this->concrete_init();

			if ($this->Query->message->text === 'Каталог') {
				$this->send($this->Query);
			} else {
				if (stripos($this->Query->callback_query->data, ($this->edit_query . $this->ucode) )) {
					$data = $this->parse_data($this->Query->callback_query->data);

					switch ($data) {
						case 'general':
							$this->back_to_general($this->Query);
							break;
						
						default:
							$this->concrete_eventbus($this->Query, $data);
							break;
					}
				}
			}
		}

		function send ($Query) {
			file_get_contents(
				BASE_URL . 'sendphoto?chat_id=' . $this->Query->message->from->id . 
				'&photo=' . $this->set_photo() .
				'&caption=' . $this->set_general_text() . $this->set_general_markup()
			);
		}

		function back_to_general ($Query) {
			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $this->set_general_text() .
				'&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . $this->set_general_markup()
			);
		}

		function parse_data($data) {
			$data = explode('"', $data);
			$data = implode($data);

			$data = explode($this->edit_query . $this->ucode, $data);
			$data = implode($data);
			return $data;
		}
	}
?>