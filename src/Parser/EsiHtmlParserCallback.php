<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/7/17
 * Time: 11:46 PM
 */

namespace Esi\Parser;



use HTML5\Tokenizer\HtmlCallback;

class EsiHtmlParserCallback implements HtmlCallback
{

    public function onWhitespace(string $ws, int $lineNo)
    {
        // TODO: Implement onWhitespace() method.
    }

    public function onTagOpen(string $name, array $attributes, $isEmpty, $ns = null, int $lineNo)
    {
        // TODO: Implement onTagOpen() method.
    }

    public function onText(string $text, int $lineNo)
    {
        // TODO: Implement onText() method.
    }

    public function onTagClose(string $name, $ns = null, int $lineNo)
    {
        // TODO: Implement onTagClose() method.
    }

    public function onProcessingInstruction(string $data, int $lineNo)
    {
        // TODO: Implement onProcessingInstruction() method.
    }

    public function onComment(string $data, int $lineNo)
    {
        // TODO: Implement onComment() method.
    }
}