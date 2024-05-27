<?php

use Prestashop\Testing\Database\DatabaseParametersOverrideProcessor;

$baseIncludesFileName = 'vendor/prestashop-module-testing-database/BaseIncludes.php';

if (!file_exists($baseIncludesFileName)) {
    echo '[ERROR] ' . 'Failed to include BaseIncludes.php file' . PHP_EOL;

    return;
}

include_once $baseIncludesFileName;

$newDatabaseName = 'prestashop_test';

$override = new DatabaseParametersOverrideProcessor($parametersPath, $parameters, 'vendor/prestashop-module-testing-database/temp/parameters.php.bak');

try {
    $override->override($newDatabaseName);
} catch (Throwable $exception) {
    echo '[ERROR] ' . $exception->getMessage() . PHP_EOL;

    return;
}

echo '[SUCCESS] Operation use test database successful';
