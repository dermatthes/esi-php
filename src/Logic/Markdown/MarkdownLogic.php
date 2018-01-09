<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 14:20
 */

namespace Esi\Logic\Markdown;


use cebe\markdown\MarkdownExtra;
use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;

class MarkdownLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        return "markdown";
    }

    public function onBeginBuild(
        Tag $tag,
        Node $parentNode,
        DocumentNode $documentNode
    ) {

    }

    public function runLogic(
        TagNode $myTagNode,
        RenderEnv $renderEnv
    ) {
        $content = $myTagNode->getTextContent();
        $content = str_replace("\n\r", "\n", $content);
        $parser = new MarkdownExtra();


        if (preg_match("/\\n(\s*?)\S/im", $content, $maches)) {
            // Strip leading spaces
            $content = str_replace("\n" . $maches[1], "\n", $content);
        }

        $content = preg_replace_callback(
            '/(src|href)=(\"|\')(.*?)\2/im',
            function ($matches) use ($renderEnv) {
                $src = $matches[3];
                $src = $renderEnv->getDocumentNode()->getTemplateEnv()->getPath($src, false);
                return $matches[1] . "=" . $matches[2] . $src . $matches[2];
            },
            $content
        );

        $renderEnv->getOutputBuffer()->append(
            $parser->parse(
                $content
            )
        );
    }
}