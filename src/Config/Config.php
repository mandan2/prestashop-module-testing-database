<?php

namespace Prestashop\Testing\Database\Config;

class Config
{
    public const PRESTASHOP_AUTOLOAD_FILE_PATH = '../../vendor/autoload.php';
    public const PRESTASHOP_CONFIG_FILE_PATH = '../../config/config.inc.php';
    public const PRESTASHOP_PARAMETERS_FILE_PATH = '../../app/config/parameters.php';
    public const BASE_INCLUDES_FILE_PATH = 'vendor/prestashop-module-testing-database/BaseIncludes.php';
    public const DATABASE_BACKUP_FILE_PATH = 'vendor/prestashop-module-testing-database/temp/backup.sql';
    public const NEW_DATABASE_NAME = 'prestashop_test';
    public const PARAMETERS_BACKUP_FILE_PATH = 'vendor/prestashop-module-testing-database/temp/parameters.php.bak';
}