<?php

use Prestashop\Testing\Database\Config\Config;
use Prestashop\Testing\Database\Processor\CreateTestingDatabaseProcessor;

if (!file_exists('vendor/prestashop-module-testing-database/vendor/autoload.php')) {
    echo '[ERROR] ' . 'Failed to reach autoload' . PHP_EOL;

    return;
}

if (!file_exists( Config::BASE_INCLUDES_FILE_PATH)) {
    echo '[ERROR] ' . 'Failed to include BaseIncludes.php file' . PHP_EOL;

    return;
}

include_once  Config::BASE_INCLUDES_FILE_PATH;

$databaseHost = $parameters['parameters']['database_host'];
$databasePort = $parameters['parameters']['database_port'];
$originalDatabaseName = $parameters['parameters']['database_name'];
$databaseUser = $parameters['parameters']['database_user'];
$databasePassword = $parameters['parameters']['database_password'];

$newDatabaseName = Config::NEW_DATABASE_NAME;
$databaseBackupFile = Config::DATABASE_BACKUP_FILE_PATH;

$createTestingDatabaseProcessor = new CreateTestingDatabaseProcessor(
    $databaseHost,
    $databasePort,
    $originalDatabaseName,
    $databaseUser,
    $databasePassword,
    $databaseBackupFile,
    $newDatabaseName
);

try {
    $createTestingDatabaseProcessor->run();
} catch (Throwable $exception) {
    echo '[ERROR] ' . $exception->getMessage() . PHP_EOL;

    return;
}

echo '[SUCCESS] Operation create testing database successful';
