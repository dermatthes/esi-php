<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:21 PM
 */

namespace Esi\Template;


class TextNode implements Node
{

    private $text = "";

    public function addText (string $text)
    {
        $this->text .= $text;
    }

    public function getText ()
    {
        return $this->text;
    }

    public function isEmpty ()
    {
        return (trim ($this->text) === "");
    }

}