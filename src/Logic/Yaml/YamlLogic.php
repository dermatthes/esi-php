<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 14:20
 */

namespace Esi\Logic\Yaml;


use cebe\markdown\MarkdownExtra;
use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;
use EYAML\EYAML;

class YamlLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        return "yaml";
    }

    public function build(
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

        if (preg_match("/\\n(\s*?)\S/im", $content, $maches)) {
            // Strip leading spaces
            $content = str_replace("\n" . $maches[1], "\n", $content);
        }

        $template = EYAML::Parse($content);

    }
}