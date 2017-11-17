<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:26 PM
 */

namespace Esi\Template;


class DefaultOutputBuffer implements OutputBuffer
{

    private $buffer = "";

    public function append(string $text)
    {
        $this->buffer .= $text;
    }

    public function getContents () : string
    {
        return $this->buffer;
    }

    public function flush()
    {
        echo $this->buffer;
        $this->buffer = "";
        flush();
    }

    public function getOriginal(): OutputBuffer
    {
        return $this;
    }
}