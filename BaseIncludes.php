<?php

$autoload = 'vendor/prestashop-module-testing-database/vendor/autoload.php';
$prestashopAutoload = '../../vendor/autoload.php';
$prestashopConfig = '../../config/config.inc.php';
$parametersPath = '../../app/config/parameters.php';

if (!file_exists($autoload)) {
    echo '[ERROR] ' . 'Failed to reach autoload' . PHP_EOL;

    return;
}

if (!file_exists($prestashopAutoload)) {
    echo '[ERROR] ' . 'Failed to reach PrestaShop autoload' . PHP_EOL;

    return;
}

if (!file_exists($parametersPath)) {
    echo '[ERROR] ' . 'Failed to reach database config parameters' . PHP_EOL;

    return;
}

require_once $autoload;
require_once $prestashopAutoload;
require_once $prestashopConfig;

$parameters = include($parametersPath);
