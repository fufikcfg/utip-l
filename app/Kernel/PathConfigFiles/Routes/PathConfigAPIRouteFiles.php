<?php

namespace App\Kernel\PathConfigFiles\Routes;

use App\Kernel\PathConfigFiles\AbstractPathConfigFiles;
use Illuminate\Support\Facades\Route;

class PathConfigAPIRouteFiles extends AbstractPathConfigFiles
{
    public function __construct()
    {
        $this->setConfig('API');
        $this->setPregReplacePath(false);
    }

    public function handle(): array
    {
        return $this->getFilesInDirectory();
    }
}
