<?php

namespace Prestashop\Testing\Database\Processor;

class CreateTestingDatabaseProcessor
{
    private $databaseHost;
    private $databasePort;
    private $originalDatabaseName;
    private $databaseUser;
    private $databasePass;
    private $backupFile;
    private $newDatabaseName;

    public function __construct(
        $databaseHost,
        $databasePort,
        $originalDatabaseName,
        $databaseUser,
        $databasePass,
        $backupFile,
        $newDatabaseName
    ) {
        $this->databaseHost = $databaseHost;
        $this->databasePort = $databasePort;
        $this->originalDatabaseName = $originalDatabaseName;
        $this->databaseUser = $databaseUser;
        $this->databasePass = $databasePass;
        $this->backupFile = $backupFile;
        $this->newDatabaseName = $newDatabaseName;
    }

    /**
     * @throws \Exception
     */
    public function run()
    {
        if (file_exists($this->backupFile)) {
            $this->createDatabase();

            return;
        }

        $command = sprintf(
            'mysqldump -h %s %s -u %s -p%s %s > %s',
            $this->databaseHost,
            $this->getPortForDatabaseDump(),
            $this->databaseUser,
            $this->databasePass,
            $this->originalDatabaseName,
            $this->backupFile
        );

        system($command, $output);

        if ($output !== 0) {
            throw new \Exception('Failed to create database backup. Query: ' . $command);
        }

        $this->createDatabase();
    }

    /**
     * @throws \Exception
     */
    private function createDatabase()
    {
        $command = sprintf(
            'mysql -h %s %s -u %s -p%s -e "DROP DATABASE IF EXISTS %s;"',
            $this->databaseHost,
            $this->getPortForDatabaseDump(),
            $this->databaseUser,
            $this->databasePass,
            $this->newDatabaseName
        );

        system($command, $output);

        if ($output !== 0) {
            throw new \Exception('Failed to drop existing database');
        }

        $command = sprintf(
            'mysql -h %s %s -u %s -p%s -e "CREATE DATABASE IF NOT EXISTS %s;"',
            $this->databaseHost,
            $this->getPortForDatabaseDump(),
            $this->databaseUser,
            $this->databasePass,
            $this->newDatabaseName
        );

        system($command, $output);

        if ($output !== 0) {
            throw new \Exception('Failed to create new database');
        }

        $command = sprintf(
            'mysql -h %s %s -u %s -p%s %s < %s',
            $this->databaseHost,
            $this->getPortForDatabaseDump(),
            $this->databaseUser,
            $this->databasePass,
            $this->newDatabaseName,
            $this->backupFile
        );

        system($command, $output);

        if ($output !== 0) {
            throw new \Exception('Failed to upload testing database dump');
        }
    }

    private function getPortForDatabaseDump(): string
    {
        if (empty($this->databasePort)) {
            return '';
        }

        return '-P ' . $this->databasePort;
    }
}
