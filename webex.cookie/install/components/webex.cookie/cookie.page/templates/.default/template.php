<p class="text-secondary">
    (Дата вступления в силу: 1 июня 2025 г.)
</p>
<p>
    <b>1. Что такое cookies?</b>
</p>
<p>
    Файлы cookie — это небольшие текстовые файлы, которые сохраняются на вашем устройстве при посещении сайта. Они помогают:
</p>
<ul type="disc">
    <li>Запоминать ваши предпочтения (язык, регион).</li>
    <li>Анализировать поведение пользователей для улучшения сайта.</li>
    <li>Обеспечивать безопасность и защиту от мошенничества.</li>
</ul>
<p>
    <b>2. Какие типы cookies мы используем?</b>
</p>
<table cellpadding="0" class="table table-bordered">
    <thead>
    <tr>
        <td>
            <p align="center">
                Тип cookie
            </p>
        </td>
        <td>
            <p align="center">
                Назначение
            </p>
        </td>
        <td>
            <p align="center">
                Пример
            </p>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <p>
                Необходимые
            </p>
        </td>
        <td>
            <p>
                Обеспечивают работу сайта (без них функционал недоступен).
            </p>
        </td>
        <td>
            <p>
                Аутентификация, корзина покупок, все формы обратной связи.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Аналитические
            </p>
        </td>
        <td>
            <p>
                Помогают анализировать трафик и улучшать сайт.
            </p>
        </td>
        <td>
            <p>
                Яндекс.Метрика.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Маркетинговые
            </p>
        </td>
        <td>
            <p>
                Используются для персонализации рекламы.
            </p>
        </td>
        <td>
            <p>
                Ретаргетинг.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Функциональные
            </p>
        </td>
        <td>
            <p>
                Запоминают ваши настройки (тема, язык).
            </p>
        </td>
        <td>
            <p>
                Сохранение региона.
            </p>
        </td>
    </tr>
    </tbody>
</table>
<p>
    <b>3. Как управлять cookies?</b>
</p>
<p>
    Вы можете:
</p>
<ul type="disc">
    <li>Отключить cookies&nbsp;в настройках используемого браузера.</li>
    <li>Согласится на аналитические/маркетинговые cookies&nbsp;через наш инструмент согласия.</li>
    <li>Удалить cookies&nbsp;вручную в любое время.</li>
</ul>
<p>
    <b>4. Передача данных третьим лицам</b>
</p>
<ul type="disc">
    <li>Некоторые cookies (например,&nbsp;<a href="https://yandex.ru/legal/confidential/" target="_blank">Яндекс.Метрика</a>) обрабатываются сторонними сервисами. Их политика:</li>
    <li><a href="https://yandex.ru/legal/confidential/" target="_blank">Яндекс.Метрика</a>&nbsp;-&nbsp;<a href="https://yandex.ru/support/metrica/ru/general/cookie-usage">https://yandex.ru/support/metrica/ru/general/cookie-usage</a></li>
</ul>
<p><b>5. Изменения в политике</b></p>
<p>Мы можем обновлять этот документ. Актуальная версия всегда доступна на этой странице.</p>
<hr size="0" width="100%" align="center">
<br>
<h4>Контакты</h4>
<p>Если у вас есть вопросы, пишите:</p>

<?php if ($arParams['EMAIL']) { ?>
    <p>📧&nbsp;Email:&nbsp;<a href="mailto:<?=$arParams['EMAIL']?>"><?=$arParams['EMAIL']?></a></p>
<?php } ?>

<?php if ($arParams['PHONE']) {
    $arParams['PHONE_CLEAR'] = $arParams['PHONE'];?>
    <p>📞&nbsp;Телефон:&nbsp;<a href="tel:<?=formatPhoneNumber($arParams['PHONE'])?>"><?=$arParams['PHONE']?></a></p>
<?php }

function formatPhoneNumber($phone): string
{
    // Удаляем все символы, кроме цифр
    $digits = preg_replace('/[^\d]/', '', $phone);

    // Если номер начинается с 7 или 8 (российские номера)
    if (preg_match('/^[78]\d{10}$/', $digits)) {
        return '+7' . substr($digits, -10);
    }
    // Если номер начинается не с 7/8, но имеет 11 цифр (возможно, с кодом страны)
    elseif (preg_match('/^\d{11}$/', $digits)) {
        return '+' . $digits;
    }
    // Для других случаев (международные номера)
    elseif (!empty($digits)) {
        return '+' . $digits;
    }

    return ''; // Возвращаем пустую строку, если номер не распознан
}
?>