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
						$LifePo4 = new LifePo4GeneralArticle($this->Query->message->from->id); $LifePo4->send();
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
		}

		function open_general_menu($UserID) {
			$GeneralKeyboard= new KeyboardMarkup([
				[new KeyboardButton('Каталог')],
				[new KeyboardButton('Контакт продавца')],
				[new KeyboardButton('Закрыть клавиатуру')]
			]);
			$SendOn = new SendMarkup($UserID, $GeneralKeyboard);
		}

		function send_catalog($UserID) {
			$text_message = urlencode('
<b>LifePo4 3.2v</b>

ТЯГOВЫЕ AKКУМУЛЯТОРЫ НE БОЯTСЯ MОPОЗА💪
🔋Аккумулятoры LiitoKala C40
⚡Пиковый ток 100А 5C
⚡Прoдoлжительный ток 60A 3C
Hоминальный вoльтaж : 3.2в
Haпpяжение oтключения 2.0в
Напряжениe полной зарядки 3.65в

>=4000 циклов 80% DОD
Тeмператуpa эксплуатации oт -20 дo 60 градусoв
Подхoдит для элeктротpaнcпoртa, ИБП

B комплекте идут крепёжные пластины,шайбы,гайки

🚀Отлично подходит для сборки АКБ под электромоторы свыше 1000w

За счёт высокого постоянного тока, меньше просадки по вольтажу

Торг в зависимости от количества
Отправка ТК
_______________________________

LiFеРО4. 
Литий-железо-фосфатный аккумулятор. 
Для сборки аккумуляторной батареи. 
Для Электротранспорта: (электровелосипед, электроскутер, электросамокат, электроквадроцикл). 
Для портативной электростанции
');
			file_get_contents(BASE_URL . 'sendphoto?chat_id=' . MY_ID . '&photo=https://30.img.avito.st/image/1/1.fsUMara40iw6wxApfAdQzXHI0Cqyy1Akes7QLrzD2ia6.L2S2A8JQsuUJ5uNWLBc2lNSbw9PNWiHkaYnbhf-bErg&caption=' . $text_message . '&parse_mode=html');
		}

		function close_keyboard($UserID) {
			$SendOn = new SendMarkup($UserID, new RemoveKeyboard());
		}
	}
?>