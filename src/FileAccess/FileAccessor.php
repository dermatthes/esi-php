<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/8/17
 * Time: 1:03 AM
 */

namespace Esi\FileAccess;


interface FileAccessor
{


    public function getContents(string $url) : string;

}