<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 11/14/17
 * Time: 1:30 AM
 */

namespace Esi\Logic;


use Esi\Parser\EsiContext;
use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\OutputBuffer;
use Esi\Template\Tag;
use Esi\Template\VarScope;

class IncludeLogic implements EsiLogic
{

    private $src;

    public function getResponsibleName(): string
    {
        return "include";
    }

    public function build(Tag $tag, DocumentNode $documentNode, Node $parentNode)
    {
        $this->src = $tag->getAttributes()["src"];
    }

    public function runLogic(
        VarScope $scope,
        OutputBuffer $ob,
        EsiNode $myNode,
        EsiNode $parentNode,
        DocumentNode $document,
        EsiContext $esiContext
    )
    {
        $doc = $esiContext->render($document->getTemplateEnv()->path($this->src));
        $doc->render(new VarScope(), $ob);
    }
}