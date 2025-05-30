<?php

use Bitrix\Main\Config\Option;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CookieConsentComponent extends CBitrixComponent
{
    public $module_id = 'webex.cookie';

    public function executeComponent()
    {
        $this->arResult['COOKIE_PAGE'] = Option::get($this->module_id, "cookiePage");
        $this->arResult['LOAD_METRICS'] = Option::get($this->module_id, 'loadMetrics', "N");
        $this->arResult['METRICS'] = Option::get($this->module_id, 'metrics');

        $this->includeComponentTemplate();
    }
}
