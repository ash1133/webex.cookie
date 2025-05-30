<?php

use Bitrix\Main\Config\Option;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class CookiePageComponent extends CBitrixComponent
{
    public $module_id = 'webex.cookie';

    public function executeComponent()
    {
        $this->includeComponentTemplate();
    }
}
