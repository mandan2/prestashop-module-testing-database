<?php

namespace Prestashop\Testing\Database;

class DatabaseParametersOverrideProcessor
{
    private $parametersFile;
    private $parametersArray;
    private $backupFile;

    public function __construct($parametersFile, $parametersArray, $backupFile)
    {
        $this->parametersFile = $parametersFile;
        $this->parametersArray = $parametersArray;
        $this->backupFile = $backupFile;
    }

    /**
     * @throws \Exception
     */
    public function override($databaseName)
    {
        if (!copy($this->parametersFile, $this->backupFile)) {
            throw new \Exception('Failed to backup parameters file');
        }

        $this->parametersArray['parameters']['database_name'] = $databaseName;

        $newContent = "<?php\n return " . var_export($this->parametersArray, true) . ";";

        if (file_put_contents($this->parametersFile, $newContent) === false) {
            throw new \Exception('Failed to replace parameters file');
        }
    }

    /**
     * @throws \Exception
     */
    public function restore()
    {
        if (!file_exists($this->backupFile)) {
            throw new \Exception('Backup file does not exist');
        }

        if (!copy($this->backupFile, $this->parametersFile)) {
            throw new \Exception('Failed to restore parameters file');
        }
    }
}
