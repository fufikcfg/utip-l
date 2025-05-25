<?php

namespace App\Kernel\PathConfigFiles\Migrations;

use App\Kernel\PathConfigFiles\AbstractPathConfigFiles;

class PathConfigMigrationFiles extends AbstractPathConfigFiles
{
    public function __construct()
    {
        $this->setConfig('Migrations');
    }

    public function handle(): array
    {
        return $this->getFilesInDirectory();
    }
}
