$text = <<<TXT
<p class="big">
	Год основания:<b>1589 г.</b> Волгоград отмечает день города в <b>2-е воскресенье сентября</b>. <br>В <b>2023 году</b> эта дата - <b>10 сентября</b>.
</p>
<p class="float">
	<img src="https://www.calend.ru/img/content_events/i0/961.jpg" alt="Волгоград" width="300" height="200" itemprop="image">
	<span class="caption gray">Скульптура «Родина-мать зовет!» входит в число семи чудес России (Фото: Art Konovalov, по лицензии shutterstock.com)</span>
</p>
<p>
	<i><b>Великая Отечественная война в истории города</b></i></p><p><i>Важнейшей операцией Советской Армии в Великой Отечественной войне стала <a href="https://www.calend.ru/holidays/0/0/1869/">Сталинградская битва</a> (17.07.1942 - 02.02.1943). Целью боевых действий советских войск являлись оборона  Сталинграда и разгром действовавшей на сталинградском направлении группировки противника. Победа советских войск в Сталинградской битве имела решающее значение для победы Советского Союза в Великой Отечественной войне.</i>
</p>
TXT;

// Функция для обрезания текста до нужного количества слов
function trim_text($text, $word_limit) {
    // Убираем HTML-теги для подсчета слов
    $plain_text = strip_tags($text);
    $words = preg_split('/\s+/', $plain_text);

    // Если количество слов больше лимита, обрезаем и добавляем многоточие
    if (count($words) > $word_limit) {
        $truncated_words = array_slice($words, 0, $word_limit);
        $truncated_text = implode(' ', $truncated_words) . '...';
    } else {
        return $text; // Если слов меньше лимита, возвращаем исходный текст
    }

    // Восстанавливаем HTML-теги для сохранения форматирования
    // Используем mb_substr чтобы точно обрезать текст по символам
    $pos = mb_strpos(strip_tags($text), implode(' ', $truncated_words)) + mb_strlen(implode(' ', $truncated_words));
    return mb_substr($text, 0, $pos) . '...';
}

// Обрезаем текст до 29 слов
$trimmed_text = trim_text($text, 29);

echo $trimmed_text;
