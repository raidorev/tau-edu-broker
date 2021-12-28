<?php

use kartik\datecontrol\Module as DateControlModule;
use kartik\icons\Icon;

return [
    'adminEmail' => $_ENV['EMAIL_USERNAME'],
    'adminPass' => $_ENV['EMAIL_PASSWORD'],
    'icon-framework' => Icon::FAS,
    'bsVersion' => '4.x',
    'bsDependencyEnabled' => false,

    // format settings for displaying each date attribute (ICU format example)
    'dateControlDisplay' => [
        DateControlModule::FORMAT_DATE => 'php:d M Y',
        DateControlModule::FORMAT_TIME => 'php:H:m:s',
        DateControlModule::FORMAT_DATETIME => 'php:d M Y H:m:s',
    ],

    // format settings for saving each date attribute (PHP format example)
    'dateControlSave' => [
        DateControlModule::FORMAT_DATE => 'php:Y-m-d',
        DateControlModule::FORMAT_TIME => 'php:H:i:s',
        DateControlModule::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
];
