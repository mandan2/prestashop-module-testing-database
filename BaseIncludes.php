<?php

use Prestashop\Testing\Database\Config\Config;

if (!file_exists(Config::PRESTASHOP_AUTOLOAD_FILE_PATH)) {
    echo '[ERROR] ' . 'Failed to reach PrestaShop autoload' . PHP_EOL;

    return;
}

if (!file_exists(Config::PRESTASHOP_PARAMETERS_FILE_PATH)) {
    echo '[ERROR] ' . 'Failed to reach database config parameters' . PHP_EOL;

    return;
}

require_once Config::LOCAL_AUTOLOAD_FILE_PATH;
require_once Config::PRESTASHOP_AUTOLOAD_FILE_PATH;
require_once Config::PRESTASHOP_CONFIG_FILE_PATH;

$parameters = include_once(Config::PRESTASHOP_PARAMETERS_FILE_PATH);
