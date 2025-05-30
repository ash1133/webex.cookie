document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('cookie-consent-container');
    const acceptBtn = document.getElementById('cookie-consent-accept');

    // Проверяем, не дано ли уже согласие
    if (!document.cookie.match(/cookie_consent=/)) {
        container.style.display = 'block';

        acceptBtn.addEventListener('click', function() {
            // Устанавливаем cookie на 1 год
            const date = new Date();
            date.setFullYear(date.getFullYear() + 1);
            document.cookie = `cookie_consent=accepted; expires=${date.toUTCString()}; path=/`;

            // Скрываем баннер
            container.style.display = 'none';

            // Перезагружаем страницу для применения всех cookies
            window.location.reload();
        });
    }
});