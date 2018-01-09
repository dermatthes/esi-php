<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 17.11.17
 * Time: 14:20
 */

namespace Esi\Logic\Yaml;


use cebe\markdown\MarkdownExtra;
use Esi\Logic\EsiBuildLogic;
use Esi\Logic\EsiLogic;
use Esi\Parser\EsiContext;
use Esi\Parser\EsiDocumentFactory;
use Esi\Parser\EsiHtmlParserCallback;
use Esi\Template\DocumentNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;
use EYAML\EYAML;

class YamlLogic implements EsiBuildLogic
{

    public function getResponsibleName(): string
    {
        return "yaml";
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
        return false;
    }


    public function onEndBuild(
        Node $thisNode,
        Node $parentNode,
        EsiContext $esiContext,
        DocumentNode $documentNode
    ) {
        echo "onEndBuild";
        if ($thisNode instanceof TagNode) {
            $templateStr = str_replace("\n\r", "\n", $thisNode->getTextContent());
            if (preg_match("/\\n(\s*?)\S/im", $templateStr, $maches)) {
                // Strip leading spaces
                $templateStr = str_replace("\n" . $maches[1], "\n", $templateStr);
            }
            echo $templateStr;
            $templateData = EYAML::Parse($templateStr);



            echo $templateData;

            $factory = new EsiDocumentFactory();
            $subDoc = $factory->buildDocument($documentNode->getTemplateEnv(), $esiContext, $templateData);


            foreach ($subDoc->getChildren() as $curChild) {
                $parentNode->append($curChild);
            }
        }
    }
}