<?php
	class LifePo420Ah {

		private $ucode;
		private $edit_query;

		function __construct (private $Query) {
			$this->ucode = '1285649';
			$this->edit_query = 'editarticle';

			if ($this->Query->message->text === 'Каталог') {

				$this->send($this->Query);

			} else {

				$data = $this->Query->callback_query->data;

				if (stripos($data, ($this->edit_query . $this->ucode) )) {
					if (stripos($data, 'general')) {
						$this->general($this->Query);
						return;
					}

					if (stripos($data, 'feature')) {
						$this->feature($this->Query);
						return;
					}
					
					if (stripos($data, 'spec')) {
						$this->spec($this->Query);
						return;
					}
					
					if (stripos($data, 'callmanager')) {

						return;
					}
				}
			}
		}

		function send($Query) {
			$text = urlencode(
				<<< END
				<b>LifePo4 3.2v</b>

				🔋Аккумулятoры LiitoKala C40
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'feature') ],
						[ new InlineKeyboard('Технические Характеристики', $this->edit_query . $this->ucode . 'spec') ],
						[ new InlineKeyboard('Задать вопрос по товару', $this->edit_query . $this->ucode . 'callmanager') ],
					])
				);

			file_get_contents(
				BASE_URL . 'sendphoto?chat_id=' . $this->Query->message->from->id . 
				'&photo=https://30.img.avito.st/image/1/1.fsUMara40iw6wxApfAdQzXHI0Cqyy1Akes7QLrzD2ia6.L2S2A8JQsuUJ5uNWLBc2lNSbw9PNWiHkaYnbhf-bErg' . 
				'&caption=' . $text . $markup
			);
		}

		function general($Query) {
			$text = urlencode(
				<<< END
				<b>LifePo4 3.2v</b>

				🔋Аккумулятoры LiitoKala C40
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'feature') ],
						[ new InlineKeyboard('Технические Характеристики', $this->edit_query . $this->ucode . 'spec') ],
						[ new InlineKeyboard('Задать вопрос по товару', $this->edit_query . $this->ucode . 'callmanager') ],
					])
				);

			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $text . '&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . $markup
			);
		}

		function feature($Query) {
			$text = urlencode(
				<<< END
				<b>LifePo4 3.2v</b>

				🔋Аккумулятoры LiitoKala C40
				_______________________________

				ТЯГOВЫЕ AKКУМУЛЯТОРЫ НE БОЯTСЯ MОPОЗА💪

				Тeмператуpa эксплуатации oт -20 дo 60 градусoв

				🚀Лучшее решение для сборки элeктротpaнcпoртa свыше 1000w, ИБП

				За счёт высокого постоянного тока, меньше просадки по вольтажу

				Более 4000 циклов заряда 80% DOD
				_______________________________

				B комплекте идут крепёжные пластины, шайбы, гайки

				<b>Торг в зависимости от количества</b>
				
				📦 ДОСТАВКА: Транспортными компаниями
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode(
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Свернуть', $this->edit_query . $this->ucode . 'general') ],
						[ new InlineKeyboard('Технические Характеристики', $this->edit_query . $this->ucode . 'spec') ],
						[ new InlineKeyboard('Задать вопрос по товару', $this->edit_query . $this->ucode . 'callmanager') ],
					])
				);

			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $text .
				'&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . $markup
			);
		}

		function spec($Query) {
			$text = urlencode(
				<<< END
				<b>LifePo4 3.2v</b>

				🔋Аккумулятoры LiitoKala C40
				_______________________________

				<b>Напряжениe полной зарядки 3.65в
				Hоминальный вoльтaж : 3.2в
				Haпpяжение oтключения 2.0в

				Номинальная ёмкость 20Ah

				⚡Пиковый ток 100А 5C
				⚡Прoдoлжительный ток 60A 3C</b>
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode(
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Свернуть', $this->edit_query . $this->ucode . 'general') ],
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'feature') ],
						[ new InlineKeyboard('Задать вопрос по товару', $this->edit_query . $this->ucode . 'callmanager') ],
					])
				);

			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $text .
				'&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . 
				$markup
			);
		}
	}
?>