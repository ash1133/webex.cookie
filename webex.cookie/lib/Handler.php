<?php

namespace Webex\Cookie;

use Bitrix\Main\Config\Option;

class Handler {
    public static string $module_id = 'webex.cookie';

    public static function checkCookieConsent (): void
    {
        global $USER;
        $acceptCookie = Option::get(self::$module_id, 'acceptCookie', "N");
        if ($acceptCookie !== "Y" && !$USER->IsAuthorized()) {
            if (!isset($_COOKIE['cookie_consent']) && !defined('COOKIE_CONSENT_CHECKED')) {
                define('BX_NO_CC', true);
                $GLOBALS['APPLICATION']->IncludeComponent('webex.cookie:cookie.consent', '', [], false);

                header_remove('Set-Cookie');

                ob_start();
                register_shutdown_function(function () {
                    $content = ob_get_clean();
                    $content = preg_replace('/Set-Cookie:\s[^\n]+\n/i', '', $content);
                    echo $content;
                });
                define('COOKIE_CONSENT_CHECKED', true);
            }
        }
    }
}