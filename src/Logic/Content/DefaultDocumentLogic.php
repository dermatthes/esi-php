<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 15.11.17
 * Time: 15:19
 */

namespace Esi\Logic\Content;


use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\TextNode;

class DefaultDocumentLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        throw new \Exception("You are not allowed to call this by tags");
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
        foreach ($myTagNode->getChildren() as $curChild) {
            if ($curChild instanceof TextNode) {
                $renderEnv->getOutputBuffer()->append($curChild->getText());
                continue;
            }
            if ($curChild instanceof TagNode) {
                $curChild->_renderNode($renderEnv);
            }
        }
    }
}