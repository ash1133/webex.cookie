<?php if (!$USER->IsAuthorized()) { ?>
    <?php if ($_COOKIE['cookie_consent'] !== 'accepted') { ?>
        <div id="cookie-consent-container" style="display: none;">
            <div class="cookie-consent-banner">
                <div class="container d-flex justify-content-between align-items-center">
                    <p>Используя данный сайт, Вы соглашаетесь на обработку файлов cookie, а также подтверждаете согласие с положениями <a href="<?=$arResult['COOKIE_PAGE']?>">Политики использования cookies</a>.</p>
                    <button id="cookie-consent-accept">Принять</button>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="<?=$this->GetFolder()?>/style.css">
        <script src="<?=$this->GetFolder()?>/script.js"></script>
    <?php } ?>
<?php } ?>

<?php
if (!$USER->IsAuthorized()) {
    if ($arResult['METRICS']) {
        if ($arResult['LOAD_METRICS'] === 'Y' && $_COOKIE['cookie_consent'] === 'accepted') {
            echo $arResult['METRICS'];
        } elseif ($arResult['LOAD_METRICS'] === 'N') {
            echo $arResult['METRICS'];
        }
    }
} else {
    echo $arResult['METRICS'];
}
