<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 15.11.17
 * Time: 15:18
 */

namespace Esi\Logic\Structural;


use Esi\Logic\EsiLogic;
use Esi\Template\DocumentNode;
use Esi\Template\Node;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;

class ExtendsLogicDocumentLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        throw new \Exception("You dont want this");
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
        $myTagNode->findLogicNode(ExtendsLogic::class)->_renderNode($renderEnv);
    }
}