<?php
use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'webex.cookie',
    [
        'WebEx\\Cookie\\Handler' => 'lib/Handler.php',
    ]
);