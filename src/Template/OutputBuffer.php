<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 14:01
 */

namespace Esi\Template;


interface OutputBuffer
{
    public function append(string $text);

    public function getContents () : string;

    public function getOriginal () : OutputBuffer;

    public function flush();
}