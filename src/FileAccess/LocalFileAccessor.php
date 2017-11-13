<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/8/17
 * Time: 1:04 AM
 */

namespace Esi\FileAccess;


class LocalFileAccessor implements FileAccessor
{

    private $rootDir;

    public function __construct(string $rootDir)
    {
        $this->rootDir = $rootDir;
    }


    public function getContents(string $url): string
    {
        return file_get_contents($url);
    }
}