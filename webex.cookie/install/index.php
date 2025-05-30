<?php

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use WebEx\Address\WebExAddressHLBlock;
use WebEx\Discount\WebExDiscountHLBlock;

Loc::loadMessages(__FILE__);

class webex_cookie extends CModule
{
    public $MODULE_ID = 'webex.cookie';
    public $MODULE_GROUP_RIGHTS = 'Y';
    public $MODULE_NAME;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_DESCRIPTION;

    protected array $eventHandlers = [];

    public function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . '/version.php');

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }

        $this->MODULE_NAME = Loc::getMessage('WEBEX_COOKIE_MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('WEBEX_COOKIE_MODULE_DESCRIPTION');
        $this->PARTNER_NAME = Loc::getMessage('WEBEX_COOKIE_PARTNER_NAME');
        $this->PARTNER_URI = Loc::getMessage('WEBEX_COOKIE_PARTNER_URI');

        $this->eventHandlers = [
            ['main', 'OnAfterEpilog', 'webex.cookie', '\Webex\Cookie\Handler', 'checkCookieConsent'],
        ];
    }

    /**
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ArgumentOutOfRangeException
     * @throws \Bitrix\Main\SystemException
     */
    public function DoInstall(): bool
    {
        global $APPLICATION;

        ModuleManager::registerModule($this->MODULE_ID);

        $this->InstallFiles();
        $this->InstallDB();
        $this->InstallEvents();

        return true;
    }

    /**
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Bitrix\Main\LoaderException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\SystemException
     */
    public function DoUninstall(): true
    {
        global $APPLICATION, $step;

        $step = intval($step);

        if($step<2)
            $APPLICATION->IncludeAdminFile(
                "Удаление модуля {$this->MODULE_NAME}",
                __DIR__."/unstep1.php",
            );
        elseif($step==2) {
            $context = Application::getInstance()->getContext();
            $request = $context->getRequest();

            $this->UnInstallEvents();
            $this->UnInstallFiles();

            if (
                $request['save_data'] !== 'Y'
                && Loader::includeModule($this->MODULE_ID)
            ) {
                $this->UnInstallDB();
            }

            ModuleManager::unRegisterModule($this->MODULE_ID);
        }

        return true;
    }

    public function InstallFiles(): true
    {
        CopyDirFiles(
            __DIR__ . '/components',
            $_SERVER['DOCUMENT_ROOT'] . '/local/components',
            true, true,
        );

        return true;
    }

    public function UnInstallFiles(): true
    {
        DeleteDirFilesEx('/local/components/' . $this->MODULE_ID );
        return true;
    }

    public function InstallDB(): true
    {
//        Option::set($this->MODULE_ID, 'hlblock_discount_name', 'PersonalDiscount');
        return true;
    }

    public function UnInstallDB(): true
    {
        Option::delete($this->MODULE_ID);
        return true;
    }

    public function InstallEvents(): true
    {
        $eventManager = EventManager::getInstance();
        foreach ($this->eventHandlers as $handler) {
            $eventManager->registerEventHandler(
                $handler[0],
                $handler[1],
                $handler[2],
                $handler[3],
                $handler[4],
                $handler[5] ?: 10,
            );
        }
        return true;
    }

    public function UnInstallEvents(): true
    {
        $eventManager = EventManager::getInstance();

        foreach ($this->eventHandlers as $handler) {
            $eventManager->unRegisterEventHandler(
                $handler[0],
                $handler[1],
                $handler[2],
                $handler[3],
                $handler[4],
            );
        }

        return true;
    }

}