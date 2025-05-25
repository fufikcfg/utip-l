<?php

namespace App\Kernel\PathConfigFiles;

abstract class AbstractPathConfigFiles
{
    private string $config;

    private bool $pregReplacePath = true;

    abstract function handle(): mixed;

    protected function setConfig(string $config): void
    {
        $this->config = $config;
    }

    protected function setPregReplacePath(bool $pregReplacePath): void
    {
        $this->pregReplacePath = $pregReplacePath;
    }

    protected function getFilesInDirectory(): array
    {
        $files = [];

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(
            $this->getDirectoryModules()
        ));

        foreach ($iterator as $file) {
            if ($file->isFile()) {
                $files[] = $file->getPathname();
            }
        }

        return $this->sortingPaths($files);
    }

    private function getConfig(): string
    {
        return ucfirst($this->config);
    }

    private function getDirectoryModules(): string
    {
        return sprintf('%s', base_path('app/Modules/'));
    }

    private function sortingPaths(array $files): array
    {
        return array_filter(array_map(function ($item) {
            if (preg_match(sprintf('#/%s/.+\.php$#i', $this->getConfig()), $item)) {
                return $this->isPregReplacePath() ?
                    preg_replace('#.*?/app/#', 'app/', $item) : $item;
            }
            return null;
        }, $files));
    }

    private function isPregReplacePath(): bool
    {
        return $this->pregReplacePath;
    }
}
