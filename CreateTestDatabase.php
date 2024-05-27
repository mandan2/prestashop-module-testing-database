<?php

use Prestashop\Testing\Database\CreateTestingDatabaseProcessor;

$baseIncludesFileName = 'vendor/prestashop-module-testing-database/BaseIncludes.php';

if (!file_exists($baseIncludesFileName)) {
    echo '[ERROR] ' . 'Failed to include BaseIncludes.php file' . PHP_EOL;

    return;
}

include_once $baseIncludesFileName;

$databaseHost = $parameters['parameters']['database_host'];
$databasePort = $parameters['parameters']['database_port'];
$originalDatabaseName = $parameters['parameters']['database_name'];
$databaseUser = $parameters['parameters']['database_user'];
$databasePassword = $parameters['parameters']['database_password'];

$newDatabaseName = 'prestashop_test';
$databaseBackupFile = 'vendor/prestashop-module-testing-database/temp/backup.sql'; // TODO give ability to provide file path

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
