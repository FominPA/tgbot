<?php
	include_once 'buttons.php';

	class LifePo4GeneralArticle {

		private $text_message, $markup;

		function __construct (private $UserId) {
			$this->text_message = $this->set_text();
			$this->markup = new InlineKeyboardMarkup([
				[ new InlineKeyboard('Особенности', 'feature') ],
				[ new InlineKeyboard('Технические Характеристики', 'spec') ],
				[ new InlineKeyboard('Задать вопрос по товару', 'callmanager') ],
			]);
		}

		function set_text() {
			return urlencode( <<< END
						<b>LifePo4 3.2v</b>

						🔋Аккумулятoры LiitoKala C40
						_______________________________

						ТЯГOВЫЕ AKКУМУЛЯТОРЫ НE БОЯTСЯ MОPОЗА💪

						Тeмператуpa эксплуатации oт -20 дo 60 градусoв

						🚀Лучшее решение для сборки элeктротpaнcпoртa свыше 1000w, ИБП

						За счёт высокого постоянного тока, меньше просадки по вольтажу

						Более 4000 тысяч циклов заряда 80% DOD
						_______________________________
		
						<b>Напряжениe полной зарядки 3.65в
						Hоминальный вoльтaж : 3.2в
						Haпpяжение oтключения 2.0в
		
						Номинальная ёмкость 20Ah
		
						⚡Пиковый ток 100А 5C
						⚡Прoдoлжительный ток 60A 3C</b>
						_______________________________
		
						B комплекте идут крепёжные пластины, шайбы, гайки
						<b>Торг в зависимости от количества</b>
						Отправка ТК
						END
						/*
						_______________________________
						
						LiFеРО4. 
						Литий-железо-фосфатный аккумулятор. 
						Для сборки аккумуляторной батареи. 
						Для Электротранспорта: (электровелосипед, электроскутер, электросамокат, электроквадроцикл). 
						Для портативной электростанции
		
						*/
					) . '&parse_mode=html';
		}

		function send() {

			file_get_contents(
				BASE_URL . 'sendphoto?chat_id=' . $this->UserId . 
				'&photo=https://30.img.avito.st/image/1/1.fsUMara40iw6wxApfAdQzXHI0Cqyy1Akes7QLrzD2ia6.L2S2A8JQsuUJ5uNWLBc2lNSbw9PNWiHkaYnbhf-bErg' . 
				'&caption=' . $this->text_message . 
				'&reply_markup=' . json_encode($this->markup)
			);
		}
	} //$LifePo4 = new LifePo4GeneralArticle(MY_ID); $LifePo4->send();
?>