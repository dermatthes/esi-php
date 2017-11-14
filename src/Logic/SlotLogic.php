<?php
/**
 * Created by PhpStorm.
 * User: matthes
 * Date: 13.11.17
 * Time: 19:00
 */

namespace Esi\Logic;


use Esi\Template\DocumentNode;
use Esi\Template\EsiNode;
use Esi\Template\Node;
use Esi\Template\OutputBuffer;
use Esi\Template\RenderEnv;
use Esi\Template\Tag;
use Esi\Template\TagNode;
use Esi\Template\VarScope;

class SlotLogic implements EsiLogic
{

    public function getResponsibleName(): string
    {
        return "output-slot";
    }

    public $name = null;

    public function build(
        Tag $tag,
        DocumentNode $documentNode,
        Node $parentNode
    ) {

    }

    public function runLogic(
        TagNode $myNode,
        RenderEnv $renderEnv
    ) {

        $value = $scope->valueOf($this->name);
    }
}