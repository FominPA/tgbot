<?php
	define('TG_TOKEN', '7987115494:AAEeup0q0aPauEyRMfk9h8PtuImxHGbSo-Y');
	define('BASE_URL', 'https://api.telegram.org/bot'. TG_TOKEN .'/');
	define('MY_ID', '1852081635');

$HTMLArticle = urlencode('
<b>жирный текст</b>
<i>италик</i>
<code>код</code>
<pre>код</pre>
<u>подчеркнутый</u>
<s>перечеркнутый</s>
<pre><code class="language-php">
class SendArticle {
    function get_content() {
        return $content;
    }
}
</code></pre>
<span class="tg-spoiler">Спойлер</span>
');

	class SendArticle {
		function __construct (public $StringArticle) {
			file_get_contents(
				BASE_URL .  'sendMessage?chat_id=' . MY_ID . 
				'&text=' . $this->StringArticle . 
				'&parse_mode=html'
			);
		}
	} $SendOn = new SendArticle($HTMLArticle);
?>