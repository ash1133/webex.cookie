<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    'PARAMETERS' => [
        'PHONE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Номер телефона',
            'TYPE' => 'TEXT',
        ],
        'EMAIL' => [
            'PARENT' => 'BASE',
            'NAME' => 'Email',
            'TYPE' => 'TEXT',
        ],
        'CACHE_TIME' => ['DEFAULT' => 3600],
        'CACHE_GROUPS' => [
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => 'Учитывать права доступа',
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'Y'
        ]
    ]
];