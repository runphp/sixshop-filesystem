<?php
declare(strict_types=1);

namespace SixShop\Filesystem;


use SixShop\Core\ExtensionAbstract;
use SixShop\Filesystem\Hook\FilesystemHook;

class Extension extends ExtensionAbstract
{

    public function getHooks(): array
    {
        return [
            FilesystemHook::class
        ];
    }

    protected function getBaseDir(): string
    {
        return dirname(__DIR__);
    }
}