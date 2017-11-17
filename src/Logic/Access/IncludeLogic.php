<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/14/17
 * Time: 1:30 AM
 */

namespace Esi\Logic\Access;


use Esi\Logic\EsiLogic;
use Esi\Parser\EsiContext;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\DefaultOutputBuffer;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\VarScope;

class IncludeLogic implements EsiLogic
{

    private $src;

    public function getResponsibleName(): string
    {
        return "include";
    }

    public function build(Tag $tag, Node $parentNode, DocumentNode $documentNode)
    {
        $this->src = $tag->getAttributes()["src"];
    }

    public function runLogic(
        TagNode $myTagNode,
        RenderEnv $renderEnv
    )
    {
        $templateEnv = $renderEnv->getDocumentNode()->getTemplateEnv()->newEnv($this->src);
        $doc = $renderEnv->getEsiContext()->buildTemplate($templateEnv);

        // $renderEnv will be cloned and adjusted inside renderDocument()
        $doc->renderDocument($renderEnv);
    }
}