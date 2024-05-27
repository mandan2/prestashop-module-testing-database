<?php

use Prestashop\Testing\Database\Config\Config;
use Prestashop\Testing\Database\Processor\DatabaseParametersOverrideProcessor;

if (!file_exists('vendor/prestashop-module-testing-database/vendor/autoload.php')) {
    echo '[ERROR] ' . 'Failed to reach autoload' . PHP_EOL;

    return;
}

if (!file_exists( Config::BASE_INCLUDES_FILE_PATH)) {
    echo '[ERROR] ' . 'Failed to include BaseIncludes.php file' . PHP_EOL;

    return;
}

include_once  Config::BASE_INCLUDES_FILE_PATH;

$override = new DatabaseParametersOverrideProcessor(
    Config::PRESTASHOP_PARAMETERS_FILE_PATH,
    $parameters,
    Config::PARAMETERS_BACKUP_FILE_PATH
);
try {
    $override->override(Config::NEW_DATABASE_NAME);
} catch (Throwable $exception) {
    echo '[ERROR] ' . $exception->getMessage() . PHP_EOL;

    return;
}

echo '[SUCCESS] Operation use test database successful';
