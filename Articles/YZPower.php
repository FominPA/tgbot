<?php
	include_once 'Article.trait.php';
	class YZPower implements iArticle {

		use AbstructArticle;

		function concrete_init() { $this->ucode = '1285650'; }

		function set_photo() { return 'https://titanat.ru/wp-content/uploads/2019/10/photo_2023-04-05_12-59-20-e1681214024292-300x300.jpg'; }

		function set_general_text() {
			return urlencode(
				<<< END
				YZРоwеr зарядка LiFеРО4
				END
			) . '&parse_mode=html';
		}

		function set_general_markup() { return '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'more') ],
					])
				); 
		}

		function concrete_eventbus($Query, $data) {
			switch ($data) {
				case 'more':
					$this->more($this->Query);
					break;

				case 'stock':
					$this->stock($this->Query);
					break;

				case 'spec':
					$this->spec($this->Query);
					break;
			}
		}

		function more($Query) {
			$text = urlencode(
				<<< END
				YZРоwеr зарядка LiFеРО4
				___________________________

				Перeд закaзом обязательно (!!!) уточните в cоoбщении или по телефону наличиe конкрeтнoй мoдификaции зaрядного уcтрoйcтва.

				Заpядныe уcтройcтвa YZPower провeрены временeм и практикой, показали сeбя исключительно с пoлoжитeльной cтoроны, стaбильно рабoтают дaжe в тяжелыx, не pекомeндовaнныx условиях (высокая влажность и сильные вибрации / тряска).

				Данные устройства будучи НЕ влагозащищенными НЕ рекомендуется устанавливать стационарно в агрессивные среды с повышенной влажностью, однако они успешно прошли испытание более чем 2х летней эксплуатации при стационарной установке в спортивной рыболовной лодке и интенсивной эксплуатации в режиме соревнований.

				Производитель данных зарядных устройств имеет многолетний опыт работы и подавляющее большинство положительных отзывов о своем продукте.
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Свернуть', $this->edit_query . $this->ucode . 'general') ],
						[ new InlineKeyboard('Технические Характеристики', $this->edit_query . $this->ucode . 'spec') ],
						[ new InlineKeyboard('Наличие и цены', $this->edit_query . $this->ucode . 'stock') ]
					])
				);

			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $text .
				'&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . $markup
			);
		}

		function stock($Query) {
			$text = urlencode(
				<<< END
				YZРоwеr зарядка LiFеРО4
				___________________________

				В наличии:
				YZРоwеr зарядка LiFеРО4 АКБ: 14.6V * 10А - 2200 руб.
				YZРоwеr зарядка LiFеРО4 АКБ: 14.6V * 20А - 4500 руб.
				YZРоwеr зарядка LiFеРО4 АКБ: 29.2V * 10А – 4500 руб.
				YZРоwеr зарядка LiFеРО4 АКБ: 29.2V * 20А - 6600 руб.
				YZРоwеr зарядка LiFеРО4 АКБ: 43.8V * 10А – 6600 руб.
				YZРоwеr зарядка LiFеРО4 АКБ: 43.8V * 20А – 10400 руб.

				Под заказ доступны зарядные устройства почти на любой вольтаж и силу тока – звоните / пишите.
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'more') ],
						[ new InlineKeyboard('Технические Характеристики', $this->edit_query . $this->ucode . 'spec') ],
						[ new InlineKeyboard('Свернуть', $this->edit_query . $this->ucode . 'general') ]
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
				YZРоwеr зарядка LiFеРО4
				___________________________

				Характеристики:
				Назначение: зарядка LiFеРО4 аккумуляторов.
				Максимальный ток заряда: 10-20 А (см. модификацию)
				Разъемы / клеммы: входной – евро вилка; выходной – зажимы типа «крокодил»
				Материал: Алюминиевый корпус
				Режим работы зарядного устройства: СС (постоянный ток) / СV (постоянное напряжение)
				Рабочая температура: -20 ~ 60 градусов
				Температура хранения: -40 ~ + 80 градусов
				Влажность при эксплуатации: 20 ~ 90% относительной влажности
				Функции защиты: от перенапряжения / перегрева / перегрузки по току / короткого замыкания и полярности
				Индикатор светодиода: красный - зарядка, зеленый - зарядка завершена или подготовка к зарядке.
				END
			)
				. '&parse_mode=html';

			$markup = '&reply_markup=' . json_encode( 
					new InlineKeyboardMarkup([
						[ new InlineKeyboard('Подробнее', $this->edit_query . $this->ucode . 'more') ],
						[ new InlineKeyboard('Наличие и цены', $this->edit_query . $this->ucode . 'stock') ],
						[ new InlineKeyboard('Свернуть', $this->edit_query . $this->ucode . 'general') ]
					])
				);

			file_get_contents(
				BASE_URL . 'editMessagecaption?caption=' . $text .
				'&chat_id=' . $Query->callback_query->message->chat->id . 
				'&message_id=' . $Query->callback_query->message->message_id . $markup
			);
		}
	}
?>